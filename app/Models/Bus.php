<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
 
class Bus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['bus_no', 'supervisor_name', 'supervisor_number'];

    public function trip():HasMany{
        return $this->hasMany(Trip::class);
    }
}
