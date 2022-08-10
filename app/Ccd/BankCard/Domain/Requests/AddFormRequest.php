<?php

namespace App\Ccd\BankCard\Domain\Requests;

use App\Http\Requests\APIRequest;

class AddFormRequest extends APIRequest
{

    public function rules()
    {
        return [
            'card_number' => 'required|string|size:16',
        ];
    }

}