<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductIndexResource extends JsonResource
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
            'price' => $this->formattedPrice,
            'slug' => $this->slug,
            'description' => $this->description,
            'discount' => $this->discount,
            'stock_count' => $this->stockCount(),
            'in_stock' => $this->inStock(),
            'image' => $this->images
        ];
    }
}
