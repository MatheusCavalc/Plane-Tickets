<?php

use App\Models\Airport;
use App\Models\Company;
use App\Models\Flight;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    //$user = User::all();
    //$airports = Airport::with('departureFlights', 'destinationFlights')->get();
    //$company = Company::with('flights')->get();
    //$flight = Flight::with('company', 'departureAirport', 'destinationAirport')->get();
    //$ticket = Ticket::with('flight', 'user')->get();

    //dd($user, $airports, $company, $flight, $ticket);

    return view('welcome');
});
