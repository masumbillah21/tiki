<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeatAllocation;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){

        if(Auth::user()->user_type == 'admin'){
            $today = SeatAllocation::whereDate('created_at', '=', now())
            ->sum('total_fare');
        
        $yesterday = SeatAllocation::whereDay('created_at', '=', now()->day - 1)
            ->whereMonth('created_at', '=', now()->month)
            ->whereYear('created_at', '=', now()->year)
            ->sum('total_fare');
        
        $thisMonth = SeatAllocation::whereMonth('created_at', '=', now()->month)
            ->whereYear('created_at', '=', now()->year)
            ->sum('total_fare');
       
        $lastMonth = SeatAllocation::whereMonth('created_at', '=', now()->month - 1)
            ->whereYear('created_at', '=', now()->year)
            ->sum('total_fare');

            return view('admin.dashboard', compact('today', 'yesterday', 'thisMonth', 'lastMonth'));
        }else{
            $trips = SeatAllocation::with('trip', 'tripFrom', 'tripTo')->where('user_id', Auth::id())->get();
            
            return view('passenger.book.index', compact('trips'));
        }
        
    }
}
