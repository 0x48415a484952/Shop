<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PublicInformationResource;
use App\Models\Information;

class PublicUserResource extends JsonResource
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
            // 'information' => new PublicInformationResource(Information::findOrFail($this->id))
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'image' => $this->image
        ];
    }
}
