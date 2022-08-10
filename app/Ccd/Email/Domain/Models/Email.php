<?php

namespace App\Ccd\Email\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{

    public $table = 'email_book';

    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at'];

}