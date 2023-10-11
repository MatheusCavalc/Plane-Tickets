<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Flight;
use App\Models\Reserve;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    use HttpResponses;

    public function home()
    {
        $airport = Airport::where('name', 'Fortaleza')->first();

        $flights = Flight::with('departureAirport', 'destinationAirport')
            ->where('departure_from', $airport->id)
            ->select('departure_from', 'destination', DB::raw('MIN(ticket_price) as ticket_price'))
            ->groupBy('destination', 'departure_from')
            ->get();

        return $this->response('Flights Home', 200, $flights);
    }

    public function flights(Request $request)
    {
        $departure = Airport::where('slug', $request->departure)->first();
        $destination = Airport::where('slug', $request->destination)->first();

        $flights = Flight::with('departureAirport', 'destinationAirport')
            ->where('departure_from', $departure->id)
            ->where('destination', $destination->id)
            ->where('available_tickets', '>', 0)
            ->where('departure_time', '>', Carbon::now())
            ->get();

        return $this->response('Flights', 200, $flights);
    }

    public function details(Request $request)
    {
        $flight = Flight::with('departureAirport', 'destinationAirport', 'company')->where('id', $request->id)->first();

        return $this->response('Flight Details', 200, $flight);
    }

    public function reserve(Request $request)
    {
        $flight = Flight::where('id', $request->flight_id)->first();
        $reserve = Reserve::where('user_id', auth()->user()->id)->where('flight_id', $flight->id)->first();

        if ($reserve) {
            return $this->response('Reserve Created', 200, $reserve);
        } else {
            //queue??
            if ($flight->available_tickets > 0) {
                $flight->decrement('available_tickets', 1);

                $reserve = Reserve::create([
                    'flight_id' => $flight->id,
                    'user_id' => auth()->user()->id,
                    'reservation' => Carbon::now(),
                    'expiration' => Carbon::now()->addMinutes(30),
                ]);

                return $this->response('Reserve Created', 200, $reserve);
            } else {
                return $this->response('No Available Tickets', 200);
            }
        }
    }
}
