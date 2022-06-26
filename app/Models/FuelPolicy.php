<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FuelPolicy extends Model
{
    use HasFactory, Uuids, SoftDeletes;
    protected $fillable = [
        'title',
        'distance',
        'distance_unit',
        'cost_unit',
        'cost'
    ];
}
