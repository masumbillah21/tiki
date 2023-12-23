<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buses = Bus::all();
        return view('admin.bus.index', compact('buses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.bus.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'bus_no' => ['required', 'string', 'max:255'],
            'supervisor_name' => ['required', 'string', 'max:255'],
            'supervisor_number' => ['required', 'numeric', 'digits:11'],
            
        ]);

        $bus = Bus::create([
            'bus_no' => $request->bus_no,
            'supervisor_name' => $request->supervisor_name,
            'supervisor_number' => $request->supervisor_number,
        ]);

        if(!$bus){
            return redirect()->back()->with('error', 'Bus failed to create!');
        }
        return redirect()->back()->with('success', 'Bus created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bus $bus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bus = Bus::findOrFail($id);
        return view('admin.bus.edit', compact('bus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'bus_no' => ['required', 'string', 'max:255'],
            'supervisor_name' => ['required', 'string', 'max:255'],
            'supervisor_number' => ['required', 'numeric', 'digits:11'],
            
        ]);

        $bus = Bus::findOrFail($id)->update([
            'bus_no' => $request->bus_no,
            'supervisor_name' => $request->supervisor_name,
            'supervisor_number' => $request->supervisor_number,
        ]);

        if(!$bus){
            return redirect()->back()->with('error', 'Bus failed to update!');
        }
        return redirect()->back()->with('success', 'Bus updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bus = Bus::findOrFail($id)->delete();

        if(!$bus){
            return redirect()->back()->with('error', 'Bus failed to delete!');
        }
        return redirect()->back()->with('success', 'Bus deleted successfully!');
    }
}
