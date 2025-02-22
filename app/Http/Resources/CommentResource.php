<?php

namespace App\Http\Resources;

use App\Http\Resources\PublicUserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'title' => $this->title,
            'content' => $this->content,
            'created_at' => $this->created_at->format('Y-m-d H:i'),
            'user' => new PublicUserResource($this->user),
            // 'user' => $this->user
            
        ];
    }
}
