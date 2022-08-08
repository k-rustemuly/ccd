<?php

namespace App\Ccd\Admin\Domain\Requests;

use App\Http\Requests\APIRequest;

class SignInFormRequest extends APIRequest
{

    public function rules()
    {
        return [
            'email' => 'required|email:rfc,dns',
            'password' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('email.required'),
            'email.email' => __('email.email'),
        ];
    }
}