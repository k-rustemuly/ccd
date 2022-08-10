<?php

namespace App\Ccd\Person\Domain\Requests;

use App\Http\Requests\APIRequest;

class EditFormRequest extends APIRequest
{

    public function rules()
    {
        return [
            'full_name' => 'sometimes|required|string',
            'iin' => 'sometimes|required|string',
            'birthday' => 'sometimes|required|date',
            'gender_id' => 'sometimes|required|integer|exists:App\Ccd\Gender\Domain\Models\Gender,id'
        ];
    }

}