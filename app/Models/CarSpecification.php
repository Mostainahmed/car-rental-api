<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarSpecification extends Model
{
    use HasFactory,Uuids, SoftDeletes;
    protected $fillable = [
        'title',
        'cost',
        'is_applied_per_km',
        'minimum_travel_distance',
        'is_minimum_travel_distance_applied'
    ];
}
