<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 09 Aug 2018 15:08:26 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class BillItem
 * 
 * @property int $id
 * @property string $item_name
 * @property int $farm_id
 * @property string $expense_category
 * @property float $price
 * @property string $description
 * @property string $item_type
 * @property string $weight
 * @property string $unit_of_measurement
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property string $active
 * 
 * @property \App\Models\User $user
 * @property \App\Models\FarmAccount $farm_account
 *
 * @package App\Models
 */
class BillItem extends Eloquent
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
		'item_type',
		'weight',
		'unit_of_measurement',
		'created_by',
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
}
