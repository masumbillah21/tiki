<?php

namespace App\Http\Controllers;

use App\Models\Fare;
use Illuminate\Http\Request;

class FareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fares = Fare::all();
        return view('admin.fare.index', compact('fares'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.fare.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'fare_per_km' => 'required|numeric|between:0,9999999.99',
            'effect_from' => 'required',
        ];

        $this->validate($request, $rules);

        $fare = Fare::create([
            'fare_per_km' => $request->input('fare_per_km'),
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
        $fare = Fare::findOrFail($id);

        return view('admin.fare.edit', compact('fare'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $rules = [
            'fare_per_km' => 'required|numeric|between:0,9999999.99',
            'effect_from' => 'required',
        ];

        $this->validate($request, $rules);

        $fare = Fare::findOrFail($id)->create([
            'fare_per_km' => $request->input('fare_per_km'),
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
