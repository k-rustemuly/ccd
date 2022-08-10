<?php

namespace App\Ccd\BankAccount\Actions;

use App\Ccd\BankAccount\Domain\Requests\AddFormRequest as Request;
use App\Ccd\BankAccount\Domain\Services\AddService as Service;
use App\Responders\JsonResponder as Responder;

class AddAction
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