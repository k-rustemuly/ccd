<?php

namespace App\Ccd\Email\Domain\Requests;

use App\Http\Requests\APIRequest;

class AddFormRequest extends APIRequest
{

    public function rules()
    {
        return [
            'email' => 'sometimes|required|email:rfc,dns',
        ];
    }

}