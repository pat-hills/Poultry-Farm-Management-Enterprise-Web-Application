<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 12 Jul 2018 21:21:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FarmDrug
 * 
 * @property int $id
 * @property int $farm_id
 * @property string $drug_name
 * @property float $unit_price
 * @property string $receipt_number
 * @property \Carbon\Carbon $date_purchased
 * @property string $category
 * @property string $quantity
 * @property \Carbon\Carbon $expiry_date
 * @property int $vendor_id
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\User $user
 * @property \App\Models\FarmAccount $farm_account
 *
 * @package App\Models
 */
class FarmDrug extends Eloquent
{
	use SoftDeletes;
	protected $casts = [
		'farm_id' => 'int',
		'unit_price' => 'float',
		'vendor_id' => 'int',
		'created_by' => 'int'
	];

	protected $dates = [
		'date_purchased',
		'expiry_date'
	];

	protected $fillable = [
		'farm_id',
		'drug_name',
		'unit_price',
		'receipt_number',
		'date_purchased',
		'category',
		'quantity',
		'expiry_date',
		'vendor_id',
		'created_by'
	];

	public function user()
	{
		return $this->belongsTo(\App\User::class, 'vendor_id');
	}

	public function farm_account()
	{
		return $this->belongsTo(\App\Models\FarmAccount::class, 'farm_id');
	}
}
