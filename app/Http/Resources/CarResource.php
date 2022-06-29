<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
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
            'brand' => $this->brand,
            'car_type' => $this->carType,
            'supplier' => $this->supplier,
            'transmission' => $this->transmission,
            'lat' => $this->current_lat,
            'lng' => $this->current_lng,
            'images' => $this->images,
            'status' => $this->status
        ];
    }
}
