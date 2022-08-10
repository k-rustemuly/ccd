<?php

namespace App\Ccd\BankAccount\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{

    public $table = 'bank_account_book';

    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at'];

}