<?php

namespace App\Ccd\Admin\Domain\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'admin';

    protected $guard = "admin";

    protected $guarded = ['id'];

    protected $hidden = ['password', 'created_at', 'updated_at'];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            "type" => "admin",
        ];
    }

    public function generateAuthToken()
    {
        return \JWTAuth::fromUser($this);
    }
}