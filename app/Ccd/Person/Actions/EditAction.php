<?php

namespace App\Ccd\Person\Actions;

use App\Ccd\Person\Domain\Requests\EditFormRequest as Request;
use App\Ccd\Person\Domain\Services\EditService as Service;
use App\Responders\JsonResponder as Responder;

class EditAction
{
    public function __construct(Responder $responder, Service $service)
    {
        $this->responder = $responder;
        $this->service = $service;
    }

    public function __invoke(Request $request)
    {
        return $this->responder->withResponse(
            $this->service->handle($request->person_id, $request->validated())
        )->respond();
    }
}