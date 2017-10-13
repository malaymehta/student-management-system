<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserPost
 *
 * @package App\Http\Requests
 */
class UserPost extends FormRequest
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
        $storedId = \Request::input('id');
        if(isset($storedId)) {
            return [
                'name'            => 'bail|required|max:255',
                'role_id'         => 'bail|required|unique:batches,alias,' . \Request::input('id') . ',id|max:255',
                'title'           => 'bail|required',
                'email'           => 'bail|required|unique:users,email,' . \Request::input('id') . ',id',
                'mob_no'          => 'bail|required|unique:users,mob_no,' . \Request::input('id') . ',id|min:10|max:10',
                'gender'          => 'bail|required',
                'dob'             => 'bail|required',
                'doj'             => 'bail|required',
                'total_exp_year'  => 'bail|required',
                'total_exp_month' => 'bail|required',
                'department_id'   => 'bail|required',
                'designation_id'  => 'bail|required',
            ];
        }else{
            return [
                'name'            => 'bail|required|max:255',
                'role_id'         => 'bail|required|unique:batches,alias,' . \Request::input('id') . ',id|max:255',
                'title'           => 'bail|required',
                'email'           => 'bail|required|unique:users,email,' . \Request::input('id') . ',id',
                'mob_no'          => 'bail|required|unique:users,mob_no,' . \Request::input('id') . ',id|min:10|max:10',
                'gender'          => 'bail|required',
                'dob'             => 'bail|required',
                'doj'             => 'bail|required',
                'total_exp_year'  => 'bail|required',
                'total_exp_month' => 'bail|required',
                'department_id'   => 'bail|required',
                'designation_id'  => 'bail|required',
                'password'        => 'bail|required|min:6|max:10',
                'con_password'    => 'bail|required|min:6|max:10',
            ];
        }
    }


    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Please enter name',
            'role_id.required' => 'Please pick a role',
            'title.required' => 'Please pick a title',
            'email.required' => 'Please enter email',
            'mob_no.required' => 'Please enter mobile number',
            'gender.required' => 'Please pick a gender',
            'dob.required' => 'Please enter DOB',
            'doj.required' => 'Please enter DOJ',
            'total_exp_year.required' => 'Please pick year',
            'total_exp_month.required' => 'Please pick month',
            'department_id.required' => 'Please pick a department',
            'designation_id.required' => 'Please pick a designation',
            'password.required' => 'Please enter password',
            'con_password.required' => 'Please enter confirm password',
        ];

    }
}
