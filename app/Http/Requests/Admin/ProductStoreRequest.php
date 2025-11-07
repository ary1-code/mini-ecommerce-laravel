<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:150'

            ], 'name_en' => [
                'required',
                'string',
                'max:150'

            ], 'category_id' => [
                'required',
                'integer',
                'exists:App\Models\Category,id'

            ], 'price' => [
                'max:1000000000',
                'integer',

            ], 'disscount' => [
                'integer',
                'max:100000000',
                'min:0'

            ], 'qty' => [
                'integer',
                'max:100000',
                'min:0',

            ], 'description' => [
                'string',
                'nullable',
                'max:1000'

            ], 'images' => [
                'nullable',
                'array',


            ], 'images.*' => [
                'nullable',
                'file',
                'mimes:jpg,png,jpeg,webp',
                'max:2048'
            ],
        ];
    }
}
