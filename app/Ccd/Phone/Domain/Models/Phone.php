<?php

namespace App\Ccd\Phone\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{

    public $table = 'phone_book';

    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at'];

}