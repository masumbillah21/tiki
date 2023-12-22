<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::all();
        return view('admin.location.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.location.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'place_name' => 'required|string|max:255',
            'distance_km' => 'required|numeric|between:0,9999999.99',
            'stopage_order' => 'required|numeric|between:1,9999999',
        ];

        $this->validate($request, $rules);

        $location = Location::create([
            'place_name' => $request->input('place_name'),
            'distance_km' => $request->input('distance_km'),
            'stopage_order' => $request->input('stopage_order'),
        ]);
        if(!$location){
            return redirect()->back()->with('error', 'Location failed to create!');
        }
        return redirect()->back()->with('success', 'Location created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $location = Location::findOrFail($id);
        
        return view('admin.location.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'place_name' => 'required|string|max:255',
            'distance_km' => 'required|numeric|between:0,9999999.99',
            'stopage_order' => 'required|numeric|between:1,9999999',
        ];

        $this->validate($request, $rules);

        $location = Location::findOrFail($id)->update([
            'place_name' => $request->input('place_name'),
            'distance_km' => $request->input('distance_km'),
            'stopage_order' => $request->input('stopage_order'),
        ]);
        if(!$location){
            return redirect()->back()->with('error', 'Location failed to update!');
        }
        return redirect()->back()->with('success', 'Location updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $location = Location::findOrFail($id)->delete();

        if(!$location){
            return redirect()->back()->with('error', 'Location failed to delete!');
        }
        return redirect()->back()->with('success', 'Location deleted successfully!');
    }
}
