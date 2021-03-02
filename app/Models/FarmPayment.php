<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 12 Jul 2018 21:21:37 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FarmPayment
 * 
 * @property int $id
 * @property int $sales_id
 * @property int $farm_id
 * @property int $customer_id
 * @property string $batch_id
 * @property float $amount
 * @property string $receipt
 * @property string $description
 * @property string $mode_of_payment
 * @property string $name_of_bank
 * @property string $cheque_number
 * @property \Carbon\Carbon $cheque_date
 * @property string $transaction_id
 * @property string $operator_type
 * @property int $vendor_id
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\User $user
 * @property \App\Models\Customer $customer
 * @property \App\Models\FarmAccount $farm_account
 * @property \App\Models\FarmSale $farm_sale
 * @property \App\Models\Vendor $vendor
 *
 * @package App\Models
 */
class FarmPayment extends Eloquent
{
	use SoftDeletes;
	protected $casts = [
		'sales_id' => 'int',
		'farm_id' => 'int',
		'customer_id' => 'int',
		'amount' => 'float',
		'vendor_id' => 'int',
		'created_by' => 'int'
	];

	protected $dates = [
		'cheque_date'
	];

	protected $fillable = [
		'sales_id',
		'farm_id',
		'customer_id',
		'batch_id',
		'amount',
		'receipt',
		'description',
		'mode_of_payment',
		'name_of_bank',
		'cheque_number',
		'cheque_date',
		'transaction_id',
		'operator_type',
		'vendor_id',
		'created_by',
		'date_paid'
		
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

	public function vendor()
	{
		return $this->belongsTo(\App\Models\Vendor::class);
	}
}
