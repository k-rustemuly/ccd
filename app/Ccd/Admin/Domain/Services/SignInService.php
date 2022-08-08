<?php

namespace App\Ccd\Admin\Domain\Services;

use App\Domain\Payloads\GenericPayload;
use App\Domain\Services\Service;
use App\Ccd\Admin\Domain\Repositories\AdminRepository as Repository;
use App\Exceptions\MainException;

class SignInService extends Service
{
    protected $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function handle($data = [])
    {
        $email = $data["email"];
        $password = $data["password"];
        $user = $this->repository->getByEmail($email);
        if(!$user || !password_verify($password, $user->password)) throw new MainException("Email or password is incorrect");

        if (! $token = auth('admin')->login($user)) {
            throw new MainException("Email or password is incorrect");
        }
        return new GenericPayload(
            array(
                "user" => [
                    "name" => $user->full_name,
                    "email" => $user->email
                ],
                "token" => $token
            )
        );
    }
}