<?php

namespace App\Http\Requests\Printing;

use Illuminate\Foundation\Http\FormRequest;

class EditCompanyPrinting extends FormRequest
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
            'location'=>'required',
            'company'=>'required|max:255|min:2',
            'companyID'=>'required|numeric',
        ];
    }
}
