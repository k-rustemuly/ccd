<?php

namespace App\Ccd\Person\Domain\Requests;

use App\Http\Requests\APIRequest;

class AddFormRequest extends APIRequest
{

    public function rules()
    {
        return [
            'full_name' => 'required|string',
            'iin' => 'required|string',
            'birthday' => 'sometimes|required|date',
            'gender_id' => 'required|integer|exists:App\Ccd\Gender\Domain\Models\Gender,id'
        ];
    }

}