<?php

namespace App\Ccd\Phone\Domain\Requests;

use App\Http\Requests\APIRequest;

class AddFormRequest extends APIRequest
{

    public function rules()
    {
        return [
            'phone_number' => 'required|string',
        ];
    }

}