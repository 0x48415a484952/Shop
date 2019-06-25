<?php

namespace App\Http\Requests\Sliders;

use Illuminate\Foundation\Http\FormRequest;

class SliderStoreRequest extends FormRequest
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
            'image' =>'required|string|max:255',
            'title' => 'required|string|max:60',
            'sort' => 'required|numeric|max:2'
        ];
    }
}
