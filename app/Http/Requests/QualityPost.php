<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class QualityPost
 *
 * @package App\Http\Requests
 */
class QualityPost extends FormRequest
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
            'quality' => 'bail|required|unique:qualities,quality,'.\Request::input('id').',id|max:255',
        ];
    }


    /** Customized error messages
     * @return array
     */
    public function messages()
    {
        return [
            'quality.required' => 'Please enter quality name',
        ];

    }
}
