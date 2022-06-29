<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Car extends Model
{
    use HasFactory, Uuids, SoftDeletes;
    protected $fillable = [
        "id" ,
        "title",
        "transmission",
        "brand_id",
        "car_type_id",
        "supplier_id",
        "status",
        "current_lat",
        "current_lng",
        "location"
    ];

    public function getInactiveCars(){
        return $this->where('status', 'INACTIVE');
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }

    public function getCars($request)
    {
        return $this->getInactiveCars()->ofSearch($request)
            ->orderBy('created_at', config('settings.pagination.order_by'))
            ->paginate(config('settings.pagination.per_page'));
    }

    public function carType(){
        return $this->belongsTo(CarType::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function scopeOfSearch($query, $request){
        $carType = $request->query('car_type');
        $brand = $request->query('brand');
        $supplier = $request->query('supplier');
        $status = $request->query('status');
        $search = $request->query('search');

        if (!empty($carType)) {
            $query->whereHas('carType', function ($q) use ($carType) {
                $q->where('title', $carType);
            });
        }

        if (!empty($brand)) {
            $query->whereHas('brand', function ($q) use ($brand) {
                $q->where('title', $brand);
            });
        }

        if (!empty($supplier)) {
            $query->whereHas('supplier', function ($q) use ($supplier) {
                $q->where('title', $supplier);
            });
        }

        if (!empty($status)) {
            $query->where('status', $status);
        }

        if (!empty($location)) {
            $query->where('location', $location);
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('transmission', 'LIKE', '%' . $search . '%')
                    ->orWhere('location', 'LIKE', '%' . $search . '%');
            });
        }
        return $query;
    }
}
