<?php

namespace App\Ccd\Imei\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Imei extends Model
{

    public $table = 'imei_book';

    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at'];

}