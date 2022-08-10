<?php

namespace App\Ccd\Person\Domain\Services;

use App\Domain\Payloads\SuccessPayload;
use App\Domain\Services\Service;
use App\Ccd\Person\Domain\Repositories\PersonRepository as Repository;
use Illuminate\Support\Facades\Storage;
use App\Exceptions\MainException;

class EditService extends Service
{
    protected $repository;

    protected $uploadRepository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function handle($person_id = 0, $data = [])
    {
        if(!$this->repository->updateById($person_id, $data)) throw new MainException("Error when saving update Person");
        return new SuccessPayload(__("Success saving Person"));
    }

}