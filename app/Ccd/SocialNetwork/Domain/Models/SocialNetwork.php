<?php

namespace App\Ccd\SocialNetwork\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class SocialNetwork extends Model
{

    public $table = 'rb_social_network';

    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at'];

}