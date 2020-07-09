<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package_discount extends Model
{
    protected $table = 'packages_discount';
	protected $fillable = [
	   'customer_id',
	   'package_id',
	   'discount_percentage',
	   'updated_by',
	];
}
