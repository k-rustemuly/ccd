<?php

namespace App\Ccd\SocialNetwork\Domain\Services;

use App\Domain\Services\Service;
use App\Ccd\SocialNetwork\Domain\Repositories\SocialNetworkRepository as Repository;

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