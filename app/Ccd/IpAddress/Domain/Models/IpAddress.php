<?php

namespace App\Ccd\IpAddress\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class IpAddress extends Model
{

    public $table = 'ip_address_book';

    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at'];

}