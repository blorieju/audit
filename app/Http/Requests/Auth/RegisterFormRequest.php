<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class RegisterFormRequest extends Request
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
        // return [
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required',
        // ];

        return [
            'email' => 'required|email|unique:users',
            'password' => 'required|max:60',
            'first_name' => 'required|max:60',
            'last_name' => 'required|max:60',
            'mobile' => 'required|numeric',
            'address' => 'required|max:255',
        ];
    }
}
