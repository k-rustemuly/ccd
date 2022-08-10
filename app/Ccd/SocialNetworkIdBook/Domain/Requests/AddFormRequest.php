<?php

namespace App\Ccd\SocialNetworkIdBook\Domain\Requests;

use App\Http\Requests\APIRequest;

class AddFormRequest extends APIRequest
{

    public function rules()
    {
        return [
            'social_network_id' => 'required|integer|exists:App\Ccd\SocialNetwork\Domain\Models\SocialNetwork,id',
            'idn' => 'required|string',
        ];
    }

}