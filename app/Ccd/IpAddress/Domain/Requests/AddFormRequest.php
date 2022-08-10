<?php

namespace App\Ccd\IpAddress\Domain\Requests;

use App\Http\Requests\APIRequest;

class AddFormRequest extends APIRequest
{

    public function rules()
    {
        return [
            'ip_address' => 'required|string',
        ];
    }

}