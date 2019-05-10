<?php

namespace DevChallenge\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'client' => 'required',
            'paymode' => 'required',
            'products' => 'array|min:1',
            'products.*.qty' => 'gt:0|numeric',
        ];
    }
}
