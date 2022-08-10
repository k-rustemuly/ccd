<?php

namespace App\Ccd\Imei\Domain\Requests;

use App\Http\Requests\APIRequest;

class AddFormRequest extends APIRequest
{

    public function rules()
    {
        return [
            'imei' => 'required|string',
        ];
    }

}