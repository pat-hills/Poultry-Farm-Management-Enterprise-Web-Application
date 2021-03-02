<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 31 Aug 2018 19:35:10 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class FarmEgg
 * 
 * @property int $id
 * @property int $farm_id
 * @property string $tray_quantity
 * @property int $batch_id
 * @property int $pen_house_id
 * @property string $pen_house_identity
 * @property string $type_of_egg
 * @property string $size
 * @property string $date_recorded
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property string $eggs_remaining
 * 
 * @property \App\Models\StockTracking $stock_tracking
 * @property \App\Models\User $user
 * @property \App\Models\FarmAccount $farm_account
 * @property \App\Models\PenHouse $pen_house
 *
 * @package App\Models
 */
class FarmEgg extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'farm_id' => 'int',
		'batch_id' => 'int',
		'pen_house_id' => 'int',
		'created_by' => 'int'
	];
	

	protected $fillable = [
		'farm_id',
		'tray_quantity',
		'batch_id',
		'pen_house_id',
		'pen_house_identity',
		'type_of_egg',
		'size',
		'date_recorded',
		'created_by',
		'eggs_remaining'
	];

	public function stock_tracking()
	{
		return $this->belongsTo(\App\Models\StockTracking::class, 'batch_id');
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'created_by');
	}

	public function farm_account()
	{
		return $this->belongsTo(\App\Models\FarmAccount::class, 'farm_id');
	}

	public function pen_house()
	{
		return $this->belongsTo(\App\Models\PenHouse::class);
	}
}
