<?php

namespace App\Ccd\SocialNetworkIdBook\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class SocialNetworkIdBook extends Model
{

    public $table = 'social_network_id_book';

    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at'];

}