<?php

namespace App\Http\Controllers;

use App\Models\Fare;
use App\Models\Location;
use Illuminate\Http\Request;

class FareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fares = Fare::with('baseLocation', 'startFrom', 'destinationLocation')->get();
        
        return view('admin.fare.index', compact('fares'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::all();
        return view('admin.fare.edit', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'base_location' => 'required|exists:locations,id',
            'start_from' => 'required|exists:locations,id',
            'destination' => 'required|exists:locations,id',
            'fare_amt' => 'required|numeric|between:0,9999999.99',
            'effect_from' => 'required|date',
        ];

        $this->validate($request, $rules);

        $fare = Fare::create([
            'base_location' => $request->input('base_location'),
            'start_from' => $request->input('start_from'),
            'destination' => $request->input('destination'),
            'fare_amt' => $request->input('fare_amt'),
            'effect_from' => $request->input('effect_from'),
        ]);

        if(!$fare){
            return redirect()->back()->with('error', 'Fare failed to create!');
        }
        return redirect()->back()->with('success', 'Fare created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fare $fare)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $locations = Location::all();
        $fare = Fare::findOrFail($id);

        return view('admin.fare.edit', compact('fare', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $rules = [
            'base_location' => 'required|exists:locations,id',
            'start_from' => 'required|exists:locations,id',
            'destination' => 'required|exists:locations,id',
            'fare_amt' => 'required|numeric|between:0,9999999.99',
            'effect_from' => 'required|date',
        ];

        $this->validate($request, $rules);

        $fare = Fare::findOrFail($id)->update([
            'base_location' => $request->input('base_location'),
            'start_from' => $request->input('start_from'),
            'destination' => $request->input('destination'),
            'fare_amt' => $request->input('fare_amt'),
            'effect_from' => $request->input('effect_from'),
        ]);

        if(!$fare){
            return redirect()->back()->with('error', 'Fare failed to create!');
        }
        return redirect()->back()->with('success', 'Fare created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fare = Fare::findOrFail($id)->delete();

        if(!$fare){
            return redirect()->back()->with('error', 'Fare failed to delete!');
        }
        return redirect()->back()->with('success', 'Fare deleted successfully!');
    }
}
