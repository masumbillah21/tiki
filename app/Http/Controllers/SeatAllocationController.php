<?php

namespace App\Http\Controllers;

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
        //
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
