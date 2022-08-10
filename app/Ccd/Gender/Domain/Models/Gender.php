<?php

namespace App\Ccd\Gender\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{

    public $table = 'rb_gender';

    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at'];

}