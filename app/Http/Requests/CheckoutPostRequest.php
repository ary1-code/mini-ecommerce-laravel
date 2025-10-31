<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutPostRequest extends FormRequest
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
            'province' => [
                'required',
                'string',
                'max:50'

            ], 'city' => [
                'required',
                'string',
                'max:50'


            ], 'user_address' => [
                'required',
                'string',
                'max:150'

            ], 'postal_code' => [
                'nullable',
                'ir_postal_code'

            ], 'mobile' => [
                'nullable',
                'ir_mobile:zero'

            ], 'description' => [
                'nullable',
                'string',
                'max:500'
            ]
        ];
    }
}
