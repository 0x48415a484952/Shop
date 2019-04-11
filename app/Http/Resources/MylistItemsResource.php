<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MylistItemsResource extends JsonResource
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
            'id'    => $this->id,
            'title' => $this->title,
            'slug'  => $this->slug,
            'price' => $this->formattedPrice,
            'stock_count' => (int) $this->stockCount(),
            'in_stock' => $this->inStock()
        ];
    }
}
