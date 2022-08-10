<?php

namespace App\Ccd\Person\Domain\Services;

use App\Domain\Payloads\SuccessPayload;
use App\Domain\Services\Service;
use App\Ccd\Person\Domain\Repositories\PersonRepository as Repository;
use App\Exceptions\MainException;

class AddService extends Service
{
    protected $repository;

    protected $uploadRepository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function handle($data = [])
    {
        // $user = auth('organization')->user();
        // $organization_id = $user->organization_id;
        // $data["organization_id"] = $organization_id;
        // $data["file_order"] = $this->repository->getNextOrder($data["organization_id"], $data["club_category_id"], $data["club_subcategory_id"]);
        // $upload = $this->uploadRepository->findByUuid($data["upload_id"]);
        // if(empty($upload)) throw new MainException("File not found");
        // $data["upload_id"] = $upload["id"];
        if(!$this->repository->create($data)) throw new MainException("Error when creating new Person");
        return new SuccessPayload(__("Success creating new Person"));
    }

}