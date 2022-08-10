<?php

namespace App\Ccd\Gender\Domain\Services;

use App\Domain\Services\Service;
use App\Ccd\Gender\Domain\Repositories\GenderRepository as Repository;

class ListService extends Service
{

    protected $repository;

    public $reference;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function handle($header = [])
    {
        $this->reference = $this->repository->getAll();
        return $this->getReference();
    }

}