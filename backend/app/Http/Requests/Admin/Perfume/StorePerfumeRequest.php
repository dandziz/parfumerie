<?php

namespace App\Http\Requests\Admin\Perfume;

use App\Enums\PerfumeGender;
use App\Http\Requests\BaseRequest;
use App\Rules\PerfumePriceRule;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Validation\Rule;

class StorePerfumeRequest extends BaseRequest
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
            'code' => 'required|string|max:100|unique:perfumes,code',
            'name' => 'required|string',
            'slug' => 'required|string|max:255|unique:perfumes,slug',
            'gender' => ['required', new EnumValue(PerfumeGender::class)],
            'images' => 'required|array|max:10',
            'images.*' => 'required|image|max:10000',
            'origin' => 'required|string|max:255',
            'description' => 'required|string',
            'brand_id' => 'required|exists:brands,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'prices' => ['required', new PerfumePriceRule]
        ];
    }
}
