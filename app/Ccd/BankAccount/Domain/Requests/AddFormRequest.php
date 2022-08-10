<?php

namespace App\Ccd\BankAccount\Domain\Requests;

use App\Http\Requests\APIRequest;

class AddFormRequest extends APIRequest
{

    public function rules()
    {
        return [
            'account_number' => 'required|string|min:20|max:20',
        ];
    }

}