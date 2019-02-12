<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class EditClient extends FormRequest
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
            'company_name'=>'required|max:255|min:2',
            'specialty'=>'required|numeric',
            'client_name'=>'required|max:255|min:2|string',
            'client_phone'=>'required|numeric|digits:11',
            'address'=>'required|max:255|min:2',
            'clientId'=>'required|numeric',
        ];
    }
}
