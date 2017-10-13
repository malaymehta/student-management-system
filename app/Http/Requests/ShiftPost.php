<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ShiftPost
 *
 * @package App\Http\Requests
 */
class ShiftPost extends FormRequest
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
            'name' => 'bail|required|unique:shifts,name,'.\Request::input('id').',id|max:255',
            'start_time' => 'bail|required',
            'end_time' => 'bail|required',
        ];
    }


    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Please enter name',
            'start_time.required' => 'Please enter start time',
            'end_time.required' => 'Please enter end time',
        ];
    }
}
