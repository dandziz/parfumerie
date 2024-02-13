<?php

namespace App\Http\Requests\Customer\Address;

use App\Http\Requests\BaseRequest;
use App\Rules\PhoneNumber;

class StoreAddressRequest extends BaseRequest
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
                'string'
            ],
            'phone_number' => [
                'required',
                'string',
                new PhoneNumber()
            ],
            'company' => [
                'required',
                'string'
            ],
            'address' => [
                'required',
                'string'
            ],
            'province' => [
                'required',
                'string'
            ],
            'district' => [
                'required',
                'string'
            ],
            'ward' => [
                'required',
                'string'
            ],
            'zip_code' => [
                'required',
                'string'
            ],
            'default' => [
                'required',
                'boolean'
            ],
        ];
    }
}
