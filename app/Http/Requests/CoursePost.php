<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoursePost extends FormRequest
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
            'name' => 'bail|required|unique:courses,name,'.\Request::input('id').',id|max:255',
            'alias' => 'bail|required|unique:courses,alias,'.\Request::input('id').',id|max:255',
            'code' => 'bail|required|unique:courses,code,'.\Request::input('id').',id|max:255',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'Please enter name',
            'alias.required' => 'Please enter alias',
            'code.required' => 'Please enter code',
        ];
    }
}
