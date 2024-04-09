<?php

namespace App\Http\Requests\Customer\Cart;

use App\Http\Requests\BaseRequest;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;

class StoreCartRequest extends BaseRequest
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
            'name' => 'required|string',
            'quantity' => 'required|integer',
            'perfume_id' => ['required',
                Rule::exists('perfume_price')->where(function (Builder $query) {
                    return $query->where('id', $this->get('price_id'));
                }),
            ],
            'price_id' => ['required']
        ];
    }
}
