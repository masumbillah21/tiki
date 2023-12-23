<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Trip;
use Illuminate\Http\Request;

class BookTripControler extends Controller
{
    public function index(){
        $locations = Location::all();
        return view('book-trip', compact('locations'));
    }

    public function searchAvailability(Request $request){
        $locations = Location::all();
        $trip_date = $request->query('trip_date');
        $trip_time = $request->query('trip_time');
        $start_from = $request->query('start_from');
        $end_to = $request->query('end_to');

        $trip = Trip::where('trip_date', '=', $trip_date)
        ->where('trip_time', '=', $trip_time)->first();
        
        return view('book-trip', compact('locations','trip'));
    }
}
