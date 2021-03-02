<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 26 Jul 2018 17:20:02 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class FarmPayablesDetail
 * 
 * @property int $id
 * @property int $farm_payables_id
 * @property int $item_id
 * @property string $quantity
 * @property float $price
 * @property float $total_amount
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\User $user
 * @property \App\Models\FarmPayable $farm_payable
 * @property \App\Models\FarmItem $farm_item
 *
 * @package App\Models
 */
class FarmPayablesDetail extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'farm_payables_id' => 'int',
		'item_id' => 'int',
		'price' => 'float',
		'total_amount' => 'float',
		'created_by' => 'int'
	];

	protected $fillable = [
		'farm_payables_id',
		'item_id',
		'quantity',
		'price',
		'total_amount',
		'created_by'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'created_by');
	}

	public function farm_payable()
	{
		return $this->belongsTo(\App\Models\FarmPayable::class, 'farm_payables_id');
	}

	public function farm_item()
	{
		return $this->belongsTo(\App\Models\FarmItem::class, 'item_id');
	}
}
