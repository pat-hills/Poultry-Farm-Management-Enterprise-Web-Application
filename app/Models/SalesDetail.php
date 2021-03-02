<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 06 Aug 2018 16:05:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SalesDetail
 * 
 * @property int $id
 * @property int $sales_id
 * @property int $farm_id
 * @property int $batch_id
 * @property int $item_id
 * @property string $quantity
 * @property string $amount
 * @property string $total_amount
 * @property int $pen_house_id
 * @property string $egg_type
 * @property string $egg_size
 * @property string $unit_measurement
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\User $user
 * @property \App\Models\FarmAccount $farm_account
 * @property \App\Models\FarmItem $farm_item
 * @property \App\Models\PenHouse $pen_house
 * @property \App\Models\FarmSale $farm_sale
 *
 * @package App\Models
 */
class SalesDetail extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'sales_id' => 'int',
		'farm_id' => 'int',
		'batch_id' => 'int',
		'item_id' => 'int',
		'pen_house_id' => 'int',
		'created_by' => 'int'
	];

	protected $fillable = [
		'sales_id',
		'farm_id',
		'batch_id',
		'item_id',
		'quantity',
		'amount',
		'total_amount',
		'pen_house_id',
		'egg_type',
		'egg_size',
		'unit_measurement',
		'created_by'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'created_by');
	}

	public function farm_account()
	{
		return $this->belongsTo(\App\Models\FarmAccount::class, 'farm_id');
	}

	public function farm_item()
	{
		return $this->belongsTo(\App\Models\FarmItem::class, 'item_id');
	}

	public function pen_house()
	{
		return $this->belongsTo(\App\Models\PenHouse::class);
	}

	public function farm_sale()
	{
		return $this->belongsTo(\App\Models\FarmSale::class, 'sales_id');
	}
}
