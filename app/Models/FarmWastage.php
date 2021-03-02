<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 22 Aug 2018 10:58:30 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class FarmWastage
 * 
 * @property int $id
 * @property int $farm_id
 * @property int $batch_id
 * @property int $pen_house_id
 * @property string $feed_name
 * @property string $weight
 * @property string $unit_measurement
 * @property string $notes
 * @property \Carbon\Carbon $date_recorded
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\StockTracking $stock_tracking
 * @property \App\Models\User $user
 * @property \App\Models\FarmAccount $farm_account
 * @property \App\Models\PenHouse $pen_house
 *
 * @package App\Models
 */
class FarmWastage extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'farm_wastage';

	protected $casts = [
		'farm_id' => 'int',
		'batch_id' => 'int',
		'pen_house_id' => 'int',
		'created_by' => 'int'
	];

	protected $dates = [
		'date_recorded'
	];

	protected $fillable = [
		'farm_id',
		'batch_id',
		'pen_house_id',
		'feed_name',
		'weight',
		'unit_measurement',
		'notes',
		'date_recorded',
		'created_by'
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
