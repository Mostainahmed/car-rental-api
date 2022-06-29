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

    public function bookings(){
        return $this->hasMany(Booking::class);
    }

    public function getCarSpecifications($request)
    {
        return $this->ofSearch($request)
            ->orderBy('created_at', config('settings.pagination.order_by'))
            ->paginate(config('settings.pagination.per_page'));
    }

    public function scopeOfSearch($query, $request){
        $search = $request->query('search');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('cost', 'LIKE', '%' . $search . '%')
                    ->orWhere('minimum_travel_distance', 'LIKE', '%' . $search . '%');
            });
        }
        return $query;
    }
}
