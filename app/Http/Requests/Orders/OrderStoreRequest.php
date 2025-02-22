<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderStoreRequest extends FormRequest
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
            'address_id' => [
                'required',
                Rule::exists('addresses', 'id')->where(function($builder) {
                    $builder->where('user_id', $this->user()->id); //it's the same as saying $request->user()->id
                })
            ],

            'shipping_method_id' => [
                'required',
                'exists:shipping_methods,id'

            ]
        ];
    }
}
