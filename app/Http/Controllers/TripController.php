<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Trip;
use App\Models\Location;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $trips = Trip::with(['bus', 'startLocation', 'endLocation'])->get();
        
        return view('admin.trip.index', compact('trips'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::all();
        $buses = Bus::all();
        return view('admin.trip.edit', compact('locations', 'buses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'bus_id' => ['required', 'exists:buses,id'],
            'trip_date' => ['required'],
            'trip_time' => ['required'],
            'start_from' => ['required', 'exists:locations,id'],
            'end_to' => ['required', 'exists:locations,id'],
            
        ]);

        $bus = Trip::create([
            'bus_id' => $request->bus_id,
            'trip_date' => $request->trip_date,
            'trip_time' => $request->trip_time,
            'start_from' => $request->start_from,
            'end_to' => $request->end_to,
        ]);

        if(!$bus){
            return redirect()->back()->with('error', 'Trip failed to create!');
        }
        return redirect()->back()->with('success', 'Trip created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $locations = Location::all();
        $buses = Bus::all();
        $trip = Trip::findOrFail($id);
        return view('admin.trip.edit', compact('trip', 'locations', 'buses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'bus_id' => ['required', 'exists:buses,id'],
            'trip_date' => ['required', 'date'],
            'trip_time' => ['required'],
            'start_from' => ['required', 'exists:locations,id'],
            'end_to' => ['required', 'exists:locations,id'],
            
        ]);

        $bus = Trip::findOrFail($id)->update([
            'bus_id' => $request->bus_id,
            'trip_date' => $request->trip_date,
            'trip_time' => $request->trip_time,
            'start_from' => $request->start_from,
            'end_to' => $request->end_to,
        ]);

        if(!$bus){
            return redirect()->back()->with('error', 'Trip failed to update!');
        }
        return redirect()->back()->with('success', 'Trip updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        //
    }
}
