<?php

namespace App\Ccd\SocialNetworkBook\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class SocialNetworkBook extends Model
{

    public $table = 'social_network_book';

    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at'];

}