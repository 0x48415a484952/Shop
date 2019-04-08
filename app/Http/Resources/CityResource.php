<?php

namespace App\Http\Resources;

use App\Http\Resources\ProvinceResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'city_name_fa' => $this->city_name_fa,
            'city_name_en' => $this->city_name_en,
            'province' => new ProvinceResource($this->province)
        ];
    }
}
