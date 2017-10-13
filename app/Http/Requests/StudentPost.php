<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StudentPost
 *
 * @package App\Http\Requests
 */
class StudentPost extends FormRequest
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
            'name' => 'bail|required|max:50',
            'email' => 'bail|required|unique:students,email,'.\Request::input('id').',id|max:50',
            'gr_no' => 'bail|required|unique:students,gr_no,'.\Request::input('id').',id|max:50',
            'course_id' => 'bail|required',
            'academic_year_id' => 'bail|required',
            'section_id' => 'bail|required',
            'batch_id' => 'bail|required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
       return [
           'name.required' => 'Please enter name',
           'course_id.required' => 'Please enter course',
           'batch_id.required' => 'Please pick a batch',
           'email.required' => 'Please enter email',
           'gr_no.required' => 'Please enter GR no',
           'academic_year_id.required' => 'Please pick a year',
           'section_id.required' => 'Please pick a section',
       ];
    }

}
