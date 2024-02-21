<?php

namespace App\Http\Requests\Admin\Perfume;

use App\Enums\PerfumeGender;
use App\Http\Requests\BaseRequest;
use App\Rules\PerfumePriceRule;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Validation\Rule;

class UpdateImageIndexRequest extends BaseRequest
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
            'array' => 'required|array',
            'array.*.id' => 'required|integer|exists:media,id',
            'array.*.img_sort' => 'required|integer',
        ];
    }
}
