<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Trip extends Model
{
    use HasFactory;

    protected $fillable= ['bus_id', 'trip_date', 'trip_time', 'start_from', 'destination'];

    public function startLocation():BelongsTo{
        return $this->belongsTo(Location::class, 'start_from');
    }

    public function endLocation():BelongsTo{
        return $this->belongsTo(Location::class, 'destination');
    }

    public function bus():BelongsTo{
        return $this->belongsTo(Bus::class);
    }

    public function seat():HasMany{
        return $this->hasMany(SeatAllocation::class);
    }
}
