<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 12 Jul 2018 21:21:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Customer
 * 
 * @property int $id
 * @property int $farm_id
 * @property string $customer_code
 * @property string $name
 * @property string $contact
 * @property string $email
 * @property string $residence
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\User $user
 * @property \App\Models\FarmAccount $farm_account
 * @property \Illuminate\Database\Eloquent\Collection $farm_owings
 * @property \Illuminate\Database\Eloquent\Collection $farm_payments
 * @property \Illuminate\Database\Eloquent\Collection $farm_sales
 *
 * @package App\Models
 */
class Customer extends Eloquent
{
	use SoftDeletes;
	protected $table = 'customer';

	protected $casts = [
		'farm_id' => 'int',
		'created_by' => 'int'
	];

	protected $fillable = [
		'farm_id',
		'customer_code',
		'name',
		'contact',
		'email',
		'residence',
		'created_by'
	];

	public function user()
	{
		return $this->belongsTo(\App\User::class, 'created_by');
	}

	public function farm_account()
	{
		return $this->belongsTo(\App\Models\FarmAccount::class, 'farm_id');
	}

	public function farm_owings()
	{
		return $this->hasMany(\App\Models\FarmOwing::class);
	}

	public function farm_payments()
	{
		return $this->hasMany(\App\Models\FarmPayment::class);
	}

	public function farm_sales()
	{
		return $this->hasMany(\App\Models\FarmSale::class);
	}
}
