<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProvinceResource extends JsonResource
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
            'province_id'      => $this->id,
            'province_name_fa' => $this->province_name_fa,
            'province_name_en' => $this->province_name_en
        ];
    }
}
