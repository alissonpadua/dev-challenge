<?php

namespace DevChallenge\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellerRequest extends FormRequest
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
        $rules['name'] = 'required|string|max:255';

        if ($this->method() == 'POST') {
            $rules['email'] = 'required|string|email|max:255|unique:users';
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        if ($this->method() == 'PUT') {
            $rules['email'] = 'required|string|email|max:255|unique:users,email,' . $this->id;

            if($this->password){
                $rules['password']  = 'required|confirmed|min:8';
            }
       
        }

        return $rules;
    }
}
