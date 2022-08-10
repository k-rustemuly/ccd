<?php

namespace App\Ccd\Edrd\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Edrd extends Model
{

    public $table = 'edrd_book';

    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at'];

}