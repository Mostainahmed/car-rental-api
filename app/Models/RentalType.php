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

    public function getRentalTypes($request)
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
                    ->orWhere('description', 'LIKE', '%' . $search . '%');
            });
        }
        return $query;
    }
}
