<?php

namespace App\Http\Requests\Customer;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends BaseRequest
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
            'oldPassword' => [
                'required',
                'string',
                'min:8',
                'current_password:api'
            ],
            'password' => [
                'required',
                'string',
                'min:8',
            ],
            'passwordConfirmation' => [
                'required',
                'string',
                'min:8',
                'same:password'
            ],
        ];
    }
}
