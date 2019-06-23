<?php

namespace App\Http\Resources;


use App\Http\Resources\CityResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'user_id' => $this->user_id,
            'city' => new CityResource($this->city),
            'recipient_name' => $this->recipient_name,
            'address' => $this->address,
            'postal_code' => $this->postal_code,
            'telephone' => $this->telephone,
            'default' => $this->default
        ];
    }
}
