<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Jul 2018 23:33:56 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class FarmPayablePayment
 * 
 * @property int $id
 * @property int $farm_id
 * @property int $farm_payable_id
 * @property string $payment_code
 * @property int $vendor_id
 * @property float $amount_paid
 * @property string $receipt_number
 * @property \Carbon\Carbon $date_paid
 * @property string $mode_of_payment
 * @property string $name_of_bank
 * @property string $cheque_number
 * @property string $description
 * @property \Carbon\Carbon $date_on_cheque
 * @property string $transaction_id
 * @property string $operator_type
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property int $batch_id
 * 
 * @property \App\Models\FarmPayable $farm_payable
 * @property \App\Models\StockTracking $stock_tracking
 *
 * @package App\Models
 */
class FarmPayablePayment extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'farm_id' => 'int',
		'farm_payable_id' => 'int',
		'vendor_id' => 'int',
		'amount_paid' => 'float',
		'created_by' => 'int',
		'batch_id' => 'int'
	];

	protected $dates = [
		'date_paid',
		'date_on_cheque'
	];

	protected $fillable = [
		'farm_id',
		'farm_payable_id',
		'payment_code',
		'vendor_id',
		'amount_paid',
		'receipt_number',
		'date_paid',
		'mode_of_payment',
		'name_of_bank',
		'cheque_number',
		'description',
		'date_on_cheque',
		'transaction_id',
		'operator_type',
		'created_by',
		'batch_id'
	];

	public function farm_payable()
	{
		return $this->belongsTo(\App\Models\FarmPayable::class);
	}

	public function stock_tracking()
	{
		return $this->belongsTo(\App\Models\StockTracking::class, 'batch_id');
	}
}
