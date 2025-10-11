<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => [
                'max:100',
                'min:2',
                'required',
                'string'

            ],
            'last_name' => [
                'max:100',
                'min:2',
                'required',
                'string'
            ],
            'mobile' => [
                'required',
                'unique:App\Models\User',
                'ir_mobile:zero'
            ],
            'password' => [
                'required',
                'confirmed',
                'min:6',
            ],
            'email' => [
                'required',
                'unique:App\Models\User',
                'email',
                'max:100'
            ]
        ];
    }
}
