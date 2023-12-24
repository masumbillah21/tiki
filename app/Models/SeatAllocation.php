<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SeatAllocation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'trip_id', 'trip_from', 'trip_to', 'seat_no', 'fare_per_seat', 'total_fare'];

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function trip():BelongsTo{
        return $this->belongsTo(Trip::class);
    }

    public function tripFrom(): BelongsTo{
        return $this->belongsTo(Location::class, 'trip_from');
    }

    public function tripTo(): BelongsTo{
        return $this->belongsTo(Location::class, 'trip_to');
    }

    protected $casts = [
        'seat_no' => 'array',
    ];
}
