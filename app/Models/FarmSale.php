<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 06 Aug 2018 16:05:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class FarmSale
 * 
 * @property int $id
 * @property int $farm_id
 * @property int $customer_id
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property string $invoice_number
 * @property \Carbon\Carbon $sales_date
 * @property \Carbon\Carbon $payment_due
 * @property int $batch_id
 * 
 * @property \App\Models\StockTracking $stock_tracking
 * @property \App\Models\User $user
 * @property \App\Models\Customer $customer
 * @property \App\Models\FarmAccount $farm_account
 * @property \Illuminate\Database\Eloquent\Collection $farm_owings
 * @property \Illuminate\Database\Eloquent\Collection $farm_payments
 * @property \Illuminate\Database\Eloquent\Collection $sales_details
 *
 * @package App\Models
 */
class FarmSale extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'farm_id' => 'int',
		'customer_id' => 'int',
		'created_by' => 'int',
		'batch_id' => 'int'
	];

	protected $dates = [
		'sales_date',
		'payment_due'
	];

	protected $fillable = [
		'farm_id',
		'customer_id',
		'created_by',
		'invoice_number',
		'sales_date',
		'payment_due',
		'batch_id'
	];

	public function stock_tracking()
	{
		return $this->belongsTo(\App\Models\StockTracking::class, 'batch_id');
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'created_by');
	}

	public function customer()
	{
		return $this->belongsTo(\App\Models\Customer::class);
	}

	public function farm_account()
	{
		return $this->belongsTo(\App\Models\FarmAccount::class, 'farm_id');
	}

	public function farm_owings()
	{
		return $this->hasMany(\App\Models\FarmOwing::class, 'sales_id');
	}

	public function farm_payments()
	{
		return $this->hasMany(\App\Models\FarmPayment::class, 'sales_id');
	}

	public function sales_details()
	{
		return $this->hasMany(\App\Models\SalesDetail::class, 'sales_id');
	}
}
