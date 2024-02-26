<?php

namespace App\Http\Requests\Admin\Perfume;

use App\Enums\PerfumeGender;
use App\Http\Requests\BaseRequest;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePerfumeRequest extends BaseRequest
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
            'code' => ['required','string','max:100',
                Rule::unique('perfumes')->ignore($this->perfume->id),],
            'name' => 'required|string',
            'slug' => ['required','string','max:255',
                Rule::unique('perfumes')->ignore($this->perfume->id),],
            'gender' => ['required', new EnumValue(PerfumeGender::class)],
            'origin' => 'required|string|max:255',
            'description' => 'required|string',
            'brand_id' => 'required|exists:brands,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'status' => 'required|boolean',
            'product_information' => 'required|string'
        ];
    }
}
