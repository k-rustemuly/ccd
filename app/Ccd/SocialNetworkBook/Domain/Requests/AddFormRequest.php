<?php

namespace App\Ccd\SocialNetworkBook\Domain\Requests;

use App\Http\Requests\APIRequest;

class AddFormRequest extends APIRequest
{

    public function rules()
    {
        return [
            'social_network_id' => 'required|integer|exists:App\Ccd\SocialNetwork\Domain\Models\SocialNetwork,id',
            'account' => 'required|string',
        ];
    }

}