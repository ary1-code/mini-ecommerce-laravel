<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartUpdateQtyRequest extends FormRequest
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
            'qty' => [
                'required',
                'array'
            ],
            'qty.*.product_id' => [
                'required',
                'int',
                'exists:App\Models\Product,id'
            ],
            'qty.*.qty' => [
                'required',
                'int',
                'min:1'
            ]
        ];
    }
}
