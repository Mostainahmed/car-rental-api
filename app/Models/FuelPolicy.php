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

    public function bookings(){
        return $this->hasMany(Booking::class);
    }

    public function getFuelPolicies($request)
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
                    ->orWhere('distance', 'LIKE', '%' . $search . '%')
                    ->orWhere('cost', 'LIKE', '%' . $search . '%')
                    ->orWhere('cost_unit', 'LIKE', '%' . $search . '%')
                    ->orWhere('cost', 'LIKE', '%' . $search . '%');
            });
        }
        return $query;
    }
}
