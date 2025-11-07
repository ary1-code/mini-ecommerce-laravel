<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
        $user= request()->route()->parameter('user');

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
                'unique:App\Models\User,mobile,'.  $user->id,
                'ir_mobile:zero'
            ],
            'password' => [
                'nullable',
                'string',
                'min:6',
            ],
            'email' => [
                'required',
                'unique:App\Models\User,email,' . $user->id,
                'email',
                'max:100'
            ]
        ];
    }
}
