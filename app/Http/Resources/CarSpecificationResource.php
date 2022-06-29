<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarSpecificationResource extends JsonResource
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
            'title' => $this->title,
            'cost' => $this->cost,
            'is_applied_per_km' => $this->is_applied_per_km,
            'minimum_travel_distance' => $this->minimum_travel_distance,
            'is_minimum_travel_distance_applied' => $this->is_minimum_travel_distance_applied
        ];
    }
}
