<?php

namespace App\Ccd\BankCard\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class BankCard extends Model
{

    public $table = 'bank_card_book';

    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at'];

}