<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            "user" => $this->user,
            "car" => $this->car?CarResource::make($this->car):'',
            "total_cost" => $this->total_cost,
            "pickup_location" => $this->pickup_location,
            "arrival_location" => $this->arrival_location,
            "pickup_lat"=> $this->pickup_lat,
            "pickup_lng"=> $this->pickup_lng,
            "arrival_lat"=> $this->arrival_lat,
            "arrival_lng"=> $this->arrival_lng,
            "fuel_policy"=> $this->fuelPolicy,
            "rental_type"=> $this->rentalType,
            "car_specification"=> $this->carSpecification,
            "travel_status"=> $this->travel_status,
            "insurance_policy"=> $this->insurancePolicy,
            "date_of_travel"=> $this->date_of_travel,
            "booked_date"=> $this->booked_date
        ];
    }
}
