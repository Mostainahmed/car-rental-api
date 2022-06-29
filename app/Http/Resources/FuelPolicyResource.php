<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FuelPolicyResource extends JsonResource
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
            'distance' => $this->distance,
            'distance_unit' => $this->distance_unit,
            'cost_unit' => $this->cost_unit,
            'cost' => $this->cost,
        ];
    }
}
