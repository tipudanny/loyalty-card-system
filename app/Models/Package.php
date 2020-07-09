<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';
	protected $fillable = [
	   'p_name',
	   'p_amount',
	   'p_status',
	   'created_by',
	   'updated_by',
	];
}
