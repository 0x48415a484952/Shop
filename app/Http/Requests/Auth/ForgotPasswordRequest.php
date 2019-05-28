<?php

namespace App\Http\Requests\Auth;

use App\Rules\NationalCode;
use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
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
            'social_id' => ['required', 'numeric', 'digits:10', new NationalCode],
            'phone' => ['required', 'string', 'digits:11'],
        ];
    }
}
