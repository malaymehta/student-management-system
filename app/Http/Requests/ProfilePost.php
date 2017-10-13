<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProfilePost
 *
 * @package App\Http\Requests
 */
class ProfilePost extends FormRequest
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
            'name' => 'bail|required||max:255',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
        ];
    }


    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Please enter name',
            'country.required' => 'Please enter country',
            'state.required' => 'Please enter state',
            'city.required' => 'Please enter city',

        ];

    }
}
