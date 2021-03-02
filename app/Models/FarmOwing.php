<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 12 Jul 2018 21:21:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FarmOwing
 * 
 * @property int $id
 * @property int $farm_id
 * @property int $customer_id
 * @property int $sales_id
 * @property string $amount_due
 * @property \Carbon\Carbon $date_due
 * @property int $created_by
 * @property int $updated_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\User $user
 * @property \App\Models\Customer $customer
 * @property \App\Models\FarmAccount $farm_account
 * @property \App\Models\FarmSale $farm_sale
 *
 * @package App\Models
 */
class FarmOwing extends Eloquent
{
	use SoftDeletes;
	protected $casts = [
		'farm_id' => 'int',
		'customer_id' => 'int',
		'sales_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $dates = [
		'date_due'
	];

	protected $fillable = [
		'farm_id',
		'customer_id',
		'sales_id',
		'amount_due',
		'date_due',
		'created_by',
		'updated_by'
	];

	public function user()
	{
		return $this->belongsTo(\App\User::class, 'created_by');
	}

	public function customer()
	{
		return $this->belongsTo(\App\Models\Customer::class);
	}

	public function farm_account()
	{
		return $this->belongsTo(\App\Models\FarmAccount::class, 'farm_id');
	}

	public function farm_sale()
	{
		return $this->belongsTo(\App\Models\FarmSale::class, 'sales_id');
	}
}
