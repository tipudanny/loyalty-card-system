<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
	protected $fillable = [
	   'name',
	   'email',
	   'phone',
	   'address',
	   'dob',
	   'card_no',
	   'card_issu_date',
	   'card_expire_date',
	];
}
