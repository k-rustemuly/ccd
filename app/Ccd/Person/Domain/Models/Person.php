<?php

namespace App\Ccd\Person\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{

    public $table = 'person';

    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at'];

}