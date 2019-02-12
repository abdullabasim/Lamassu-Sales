<?php

namespace App\Http\Requests\PromotionItem;

use Illuminate\Foundation\Http\FormRequest;

class AddPromotionItem extends FormRequest
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
            'note'=>'required',
            'amount'=>'required|numeric',
            'date'=>'required',
        ];
    }
}
