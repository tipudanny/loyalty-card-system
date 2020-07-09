<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
	protected $fillable = [
	   'customer_id',
	   'package_id',
	   'service_discount',
	   'amount',
	   'service_date',
	   'remark',
	   'created_by',
	   'updated_by',
	];
}
