<?php

namespace App\Http\Requests\Admin\Perfume;

use App\Http\Requests\BaseRequest;
use Closure;

class AddImagesRequest extends BaseRequest
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
            'images' => 'required|array|max:10',
            'images.*' => 'required|image|max:10000',
        ];
    }
}
