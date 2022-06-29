<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InsurancePolicy extends Model
{
    use HasFactory, Uuids, SoftDeletes;
    protected $fillable = [
        'cost',
        'description',
        'title',
        'cost_unit'
    ];

    public function bookings(){
        return $this->hasMany(Booking::class);
    }

    public function getInsurancePolicies($request)
    {
        return $this->ofSearch($request)
            ->orderBy('created_at', config('settings.pagination.order_by'))
            ->paginate(config('settings.pagination.per_page'));
    }

    public function scopeOfSearch($query, $request){
        $search = $request->query('search');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('cost', 'LIKE', '%' . $search . '%')
                    ->orWhere('cost_unit', 'LIKE', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', '%' . $search . '%')
                    ->orWhere('title', 'LIKE', '%' . $search . '%');
            });
        }
        return $query;
    }
}
