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

        $trip = Trip::where('trip_date', '=', $trip_date)->first();
        //dd($trip);
        return view('book-trip', compact('locations','trip'));
    }
}
