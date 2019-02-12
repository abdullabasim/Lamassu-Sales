<?php

namespace App\Http\Requests\Expenses;

use Illuminate\Foundation\Http\FormRequest;

class EditExpenses extends FormRequest
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
            'expensesType'=>'required',
            'amount'=>'required|numeric',
            'note'=>'required|max:255|min:2',
            'date'=>'required',
            'expensesID'=>'required|numeric'
        ];
    }
}
