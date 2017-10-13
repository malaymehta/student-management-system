<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ShiftAllocationPost
 *
 * @package App\Http\Requests
 */
class ShiftAllocationPost extends FormRequest
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
            'shift_id' => 'bail|required',
            'effective_date' => 'bail|required',
            'emp_check' => 'bail|required',
        ];
    }


    /**
     * @return array
     */
    public function messages()
    {
        return [
            'shift_id.required' => 'Please pick a shift',
            'effective_date.required' => 'Please enter effective date',
            'emp_check.required' => 'Please pick one or more employees',
        ];
    }
}
