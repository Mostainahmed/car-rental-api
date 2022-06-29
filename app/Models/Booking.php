<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Booking extends Model
{
    use HasFactory, Uuids, SoftDeletes;
    protected $fillable = [
        "id" ,
        "user_id",
        "car_id",
        "total_cost",
        "pickup_location",
        "arrival_location",
        "pickup_lat",
        "pickup_lng",
        "arrival_lat",
        "arrival_lng",
        "fuel_policy_id",
        "rental_type_id",
        "car_specification_id",
        "travel_status",
        "insurance_policy_id",
        "date_of_travel",
        "booked_date"
    ];


    public function getBookings($request)
    {
        return $this->ofSearch($request)
            ->orderBy('created_at', config('settings.pagination.order_by'))
            ->paginate(config('settings.pagination.per_page'));
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function car(){
        return $this->belongsTo(Car::class);
    }

    public function fuelPolicy(){
        return $this->belongsTo(FuelPolicy::class);
    }

    public function rentalType(){
        return $this->belongsTo(RentalType::class);
    }

    public function carSpecification(){
        return $this->belongsTo(CarSpecification::class);
    }

    public function insurancePolicy(){
        return $this->belongsTo(InsurancePolicy::class);
    }

    public function scopeOfSearch($query, $request){
        $booking_date = $request->query('booked_date');
        $car = $request->query('car');
        $status = $request->query('travel_status');
        $search = $request->query('search');

        if (!empty($car)) {
            $query->whereHas('car', function ($q) use ($car) {
                $q->where('title', $car);
            });
        }

        if (!empty($booking_date)) {
            $query->where('booked_date', $booking_date);
        }

        if (!empty($status)) {
            $query->where('status', $status);
        }

        if (!empty($location)) {
            $query->where('location', $location);
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('date_of_travel', 'LIKE', '%' . $search . '%')
                    ->orWhere('pickup_location', 'LIKE', '%' . $search . '%')
                    ->orWhere('arrival_location', 'LIKE', '%' . $search . '%');
            });
        }
        return $query;
    }
}
