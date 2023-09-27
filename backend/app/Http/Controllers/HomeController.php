<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Flight;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    use HttpResponses;

    public function home()
    {
        $airport = Airport::where('name', 'Fortaleza')->first();

        $flights = Flight::with('departureAirport', 'destinationAirport')->where('departure_from', $airport->id)
            ->select('departure_from', 'destination', DB::raw('MIN(ticket_price) as ticket_price'))
            ->groupBy('destination', 'departure_from')
            ->get();

        return $this->response('Flights Home', 200, $flights);
    }

    public function flights(Request $request)
    {
        $departure = Airport::where('name', $request->departure)->first();
        $destination = Airport::where('name', $request->destination)->first();

        $flights = Flight::with('departureAirport', 'destinationAirport')->where('departure_from', $departure->id)->where('destination', $destination->id)->get();

        return $this->response('Flights', 200, $flights);
    }
}
