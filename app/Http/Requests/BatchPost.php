<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;


/**
 * Class ClassPost
 *
 * @package App\Http\Requests
 */
class BatchPost extends FormRequest
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
            'name' => 'bail|required|unique:batches,name,'.\Request::input('id').',id|max:255',
            'alias' => 'bail|required|unique:batches,alias,'.\Request::input('id').',id|max:255',
            'start_date' => 'bail|required',
            'end_date' => 'bail|required',
            'academic_year_id' => 'bail|required',
            'course_id' => 'bail|required',
            'status' => 'bail|required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Please enter name',
            'alias.required' => 'Please enter alias',
            'start_date.required' => 'Please enter start date',
            'end_date.required' => 'Please enter end date',
            'academic_year_id.required' => 'Please pick a year',
            'course_id.required' => 'Please pick a course',
            'status.required' => 'Please pick a status',
        ];

    }
}
