<?php

namespace App\Http\Resources\Cart;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Cart\CartProductVariationResource;

class CartResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'products' => CartProductVariationResource::collection($this->cart)
        ];
    }
}
