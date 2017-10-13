<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SectionPost
 *
 * @package App\Http\Requests
 */
class SectionPost extends FormRequest
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
            'academic_year_id' => 'bail|required',
            'batch_id' => 'bail|required',
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
            'academic_year_id.required' => 'Please pick a year',
            'batch_id.required' => 'Please pick a course',
            'status.required' => 'Please pick a status',
        ];

    }
}
