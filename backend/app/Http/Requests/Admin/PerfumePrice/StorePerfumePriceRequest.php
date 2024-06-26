<?php

namespace App\Http\Requests\Admin\PerfumePrice;

use App\Http\Requests\BaseRequest;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePerfumePriceRequest extends BaseRequest
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
        //dd($this->route('perfume')->id);
        return [
            'capacity' => [Rule::unique('perfume_price')->where(function (Builder $query) {
                return $query->where('perfume_id', $this->route('perfume')->id);
            })],
            'import_price' => 'required|integer',
            'price' => 'required|integer',
            'quantity' => 'required|boolean'
        ];
    }
}
