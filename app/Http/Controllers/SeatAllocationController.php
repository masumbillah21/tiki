<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\SeatAllocation;

class SeatAllocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::all();
        return view('admin.book.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::all();
        return view('book-trip', compact('locations'));
    }

    public function searchAvailability(Request $request){
        $rules = [
            'trip_date' => 'required|date',
            'trip_time' => 'required|string',
            'start_from' => 'required|exists:locations,id',
            'end_to' => 'required|exists:locations,id'
        ];

        $this->validate($request, $rules);

        $locations = Location::all();
        $trip_date = $request->query('trip_date');
        $trip_time = $request->query('trip_time');
        $start_from = $request->query('start_from');
        $end_to = $request->query('end_to');

        $search = (object) $request->all();

        $trip = Trip::where('trip_date', '=', $trip_date)
        ->where('trip_time', '=', $trip_time)
        ->where('start_from', '=', $start_from)  // 1 -> Dhaka  4 -> cox bazar
        ->where('destination', '=', $end_to)  // 4 -> Cox 1 -> Dhaka
        ->where('is_cancel', 0)
        ->first();

        //dd($trip);
        
        if($trip == null){
            
            $trip['message'] = 'No trip found';
            $trip = (object) $trip;
            //dd($trip);
            return view('book-trip', compact('locations','trip', 'search'));
        }

        $seats = SeatAllocation::with('trip')->where('trip_id', $trip->id);
        
        return view('book-trip', compact('locations','search','trip', 'seats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SeatAllocation $seatAllocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SeatAllocation $seatAllocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SeatAllocation $seatAllocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SeatAllocation $seatAllocation)
    {
        //
    }
}
