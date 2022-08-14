<?php

namespace App\Ccd\Edrd\Actions;

use App\Domain\Requests\DefaultRequest as Request;
use App\Ccd\Edrd\Domain\Services\SearchService as Service;
use App\Responders\JsonResponder as Responder;

class SearchAction
{

    public function __construct(Responder $responder, Service $service)
    {
        $this->responder = $responder;
        $this->service = $service;
    }

    public function __invoke(Request $request)
    {
        return $this->responder->withResponse(
            $this->service->handle($request->search)
        )->respond();
    }
}