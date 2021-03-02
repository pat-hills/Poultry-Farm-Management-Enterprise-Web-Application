<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 12 Jul 2018 21:21:37 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Income
 * 
 * @property int $id
 * @property int $farm_id
 * @property string $income_item
 * @property string $batch_id
 * @property string $item_qty
 * @property float $unit_price
 * @property string $weight
 * @property string $description
 * @property float $income_amount
 * @property string $bank_code
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\User $user
 * @property \App\Models\FarmAccount $farm_account
 *
 * @package App\Models
 */
class Income extends Eloquent
{
	use SoftDeletes;
	protected $table = 'income';

	protected $casts = [
		'farm_id' => 'int',
		'unit_price' => 'float',
		'income_amount' => 'float',
		'created_by' => 'int'
	];

	protected $fillable = [
		'farm_id',
		'income_item',
		'batch_id',
		'item_qty',
		'unit_price',
		'weight',
		'description',
		'income_amount',
		'bank_code',
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
}
