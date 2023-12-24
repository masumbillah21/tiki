<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fare extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['base_location','start_from','destination','fare_amt', 'effect_from'];
    public function baseLocation():BelongsTo{
        return $this->belongsTo(Location::class, 'base_location');
    }

    public function startFrom():BelongsTo{
        return $this->belongsTo(Location::class, 'start_from');
    }

    public function destinationLocation():BelongsTo{
        return $this->belongsTo(Location::class, 'destination');
    }
}
