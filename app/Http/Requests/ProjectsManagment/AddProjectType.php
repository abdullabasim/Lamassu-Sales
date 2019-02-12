<?php

namespace App\Http\Requests\ProjectsManagment;

use Illuminate\Foundation\Http\FormRequest;

class AddProjectType extends FormRequest
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
            'title'=>'required|max:255|min:2',
        ];
    }
}
