<?php

namespace App\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;

class AddInvoice extends FormRequest
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
            'company'=>'required',
            'client'=>'required',
            'sales_type'=>'required',
            'title.*'=>'required|max:255|min:2',
            'qty.*'=>'required|numeric',
            'desc.*'=>'required',
            'amount.*'=>'required|numeric',
            'discount'=>'required|numeric',
            'totalAmount'=>'required|numeric',
            'paidAmount'=>'required|numeric',
            'remainingAmount'=>'required|numeric',
            'payment_method'=>'required',
            'dateIssue' =>'required'
        ];
    }
}
