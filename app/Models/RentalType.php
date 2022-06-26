<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RentalType extends Model
{
    use HasFactory, Uuids, SoftDeletes;
    protected $fillable = [
        'cost',
        'description',
        'cost_unit'
    ];
}
