<?php

namespace App\Http\Resources;

use Illuminate\Support\Collection;
use App\Http\Resources\CommentResource;
use App\Http\Resources\ProductIndexResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Cart\Money;

class ProductVariationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        if ($this->resource instanceof Collection) {
            return ProductVariationResource::collection($this->resource);
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            // 'unformattedprice' => $this->price->amount(),
            'price' => $this->formattedPrice,
            'price_varies' => $this->priceVaries(),
            'stock_count' => (int) $this->stockCount(),
            'type' => $this->type->title,
            'in_stock' => $this->inStock(),
            'quantity' => $this->getQuantity(),
            // 'pivot' => $this->pivot,
            'eachsubtotalformattedprice' => $this->eachSubtotalFormattedPrice(),
            // 'pivot' => $this->pivot,
            'product' => new ProductIndexResource($this->product),
            
        ];



        
    }

    private function eachSubtotalFormattedPrice()
    {
        if ($this->pivot) {
            $subtotal = (string)($this->price->amount() * $this->pivot->quantity);
            $subtotal = new Money($subtotal);
            return $subtotal->formatted();
        }
        return null;
        
    }

    private function getQuantity()
    {
        if($this->pivot) {
            $quantity = $this->pivot->quantity;
            return $quantity;
        }
        return null;
    }
}
