<?php

namespace App\Http\Requests\ProjectsManagment;

use Illuminate\Foundation\Http\FormRequest;

class AddProject extends FormRequest
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
            'name'=>'required|max:255|min:2',
            'company'=>'required|max:255|min:2',
            'phone'=>'required|numeric',
            'projectType'=>'required|numeric',
            'project'=>'required|max:255|min:2',
            'start_date'=>'required',
            'end_date'=>'required',
            'email'=>'required|email',
            'note'=>'required',
            'price'=>'required|numeric',

        ];
    }
}
