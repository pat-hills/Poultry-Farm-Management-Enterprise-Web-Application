<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 09 Aug 2018 13:41:24 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class FarmItem
 * 
 * @property int $id
 * @property string $item_name
 * @property int $farm_id
 * @property string $expense_category
 * @property float $price
 * @property string $description
 * @property string $weight
 * @property string $unit_of_measurement
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property string $item_category
 * @property string $drug_category
 * @property string $feed_category
 * @property string $active
 * 
 * @property \App\Models\User $user
 * @property \App\Models\FarmAccount $farm_account
 * @property \Illuminate\Database\Eloquent\Collection $farm_payables_details
 * @property \Illuminate\Database\Eloquent\Collection $sales_details
 *
 * @package App\Models
 */
class FarmItem extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'farm_id' => 'int',
		'price' => 'float',
		'created_by' => 'int'
	];

	protected $fillable = [
		'item_name',
		'farm_id',
		'expense_category',
		'price',
		'description',
		'weight',
		'unit_of_measurement',
		'created_by',
		'item_category',
		'drug_category',
		'feed_category',
		'status_bill_sale',
		'active'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'created_by');
	}

	public function farm_account()
	{
		return $this->belongsTo(\App\Models\FarmAccount::class, 'farm_id');
	}

	public function farm_payables_details()
	{
		return $this->hasMany(\App\Models\FarmPayablesDetail::class, 'item_id');
	}

	public function sales_details()
	{
		return $this->hasMany(\App\Models\SalesDetail::class, 'item_id');
	}
}
