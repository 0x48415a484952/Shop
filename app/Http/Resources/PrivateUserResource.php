<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PrivateUserResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'birth_date' => $this->birth_date,
            'job' => $this->job,
            'image' => $this->image,
            'role' => $this->role,
            'social_id' => $this->social_id,
            'phone' => $this->phone,
            'role' => $this->role,
            'level' => $this->level,
            'created_at' => $this->created_at->format('Y-m-d H:i')
        ];
    }
}
