<?php

namespace App\Ccd\Phone\Domain\Services;

use App\Domain\Payloads\SuccessPayload;
use App\Domain\Services\Service;
use App\Ccd\Phone\Domain\Repositories\PhoneRepository as Repository;
use App\Exceptions\MainException;

class AddService extends Service
{
    protected $repository;

    protected $uploadRepository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function handle($person_id = 0, $data = [])
    {
        $data["person_id"] = $person_id;
        if(!$this->repository->create($data)) throw new MainException("Error when creating new phone");
        return new SuccessPayload(__("Success creating new phone"));
    }

}