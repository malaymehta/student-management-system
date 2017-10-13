<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AcademicYearPost
 *
 * @package App\Http\Requests
 */
class AcademicYearPost extends FormRequest
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
            'name' => 'bail|required|unique:academic_years,name,'.\Request::input('id').',id|max:255',
            'start_date' => 'required',
            'end_date' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Please enter name',
            'start_date.required' => 'Please enter start date',
            'end_date.required' => 'Please enter end date',

        ];

    }
}
