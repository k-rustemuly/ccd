<?php

namespace App\Ccd\Edrd\Domain\Requests;

use App\Http\Requests\APIRequest;

class AddFormRequest extends APIRequest
{

    public function rules()
    {
        return [
            'edrd_number' => 'required|string',
            'fabula' => 'required|string',
            'description' => 'required|string',
        ];
    }

}