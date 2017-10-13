<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionCategoryPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'bail|required|unique:question_categories,name,'.\Request::input('id').',id|max:30',
            'course_id' => 'bail|required',
            'description' => 'bail|required|max:255',
        ];
    }


    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Please enter name',
            'course_id.required' => 'Please pick a course',
            'description.required' => 'Please enter description',
        ];
    }
}
