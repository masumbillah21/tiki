<?php

namespace App\Http\Controllers;

use App\Models\Fare;
use App\Models\Trip;
use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\SeatAllocation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        $fare = Fare::where('start_from', $start_from)
            ->where('destination', $end_to)
            ->first();

        $search = (object) $request->all();

        if($start_from == $end_to){
            
            $trip['message'] = 'No trip found';
            $trip = (object) $trip;
            
            return view('book-trip', compact('locations','trip', 'search'));
        }

        $trip = Trip::with('startLocation','endLocation')->where('trip_date', $trip_date)
            ->where('trip_time', $trip_time)
            ->where('start_from', $fare->base_location)
            ->when($start_from > $end_to, function ($query) use ($end_to) {
                $query->where('destination', '<=', $end_to);
            }, function ($query) use ($end_to) {
                $query->where('destination', '>=', $end_to);
            })
            ->where('is_cancel', 0)
            ->first();
        

        //dd($trip);
        
        if($trip == null){
            
            $trip['message'] = 'No trip found';
            $trip = (object) $trip;
            //dd($trip);
            return view('book-trip', compact('locations','trip', 'search'));
        }

        $seats = SeatAllocation::with('trip')->where('trip_id', $trip->id)->get('seat_no');
        $seatArray = [];
        foreach($seats as $seat){
            foreach($seat->seat_no as $s){
                $seatArray[] = $s;
            }
        }

        //dd($seatArray);

        return view('book-trip', compact('locations','search','trip', 'seatArray', 'fare'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'trip_id' => 'required|exists:trips,id',
            'trip_from' => 'required|exists:locations,id',
            'trip_to' => 'required|exists:locations,id',
            'seat_no' => 'required|array',
            'fare_per_seat' => 'required|numeric|between:0,9999999.99',
        ];

        $this->validate($request, $rules);

        //dd($request->fare_per_seat * count($request->seat_no));
        $seat = SeatAllocation::create([
            'user_id' => Auth::id(),
            'trip_id' => $request->trip_id,
            'trip_from' => $request->trip_from,
            'trip_to' => $request->trip_to,
            'seat_no' => $request->seat_no,
            'fare_per_seat' => $request->fare_per_seat,
            'total_fare' => $request->fare_per_seat * count($request->seat_no),
        ]);

        if(!$seat){
            return redirect()->back()->with('error', 'Failed to book your seat!!');
        }
        return redirect()->back()->with('success', 'Seat booked successfully!');
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
