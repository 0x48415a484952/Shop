<?php

namespace App\Http\Requests\ProductVariation;

use Illuminate\Foundation\Http\FormRequest;

class ProductVariationStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'price' => 'required|string',
            'quantity' =>'required|string|max:255',
            'product_id' => 'required|numeric|min:1|exists:products,id',
            'product_variation_type_id' => 'required|numeric|min:1|exists:product_variation_types,id',
        ];
    }
}
