<?php

namespace App\Http\Requests\Debt;

use Illuminate\Foundation\Http\FormRequest;

class DebtEdit extends FormRequest
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
            'debtName'=>'required',
            'debtID'=>'required|numeric',
            'amount'=>'required|numeric',
            'date'=>'required',
            'note'=>'required',
        ];
    }
}
