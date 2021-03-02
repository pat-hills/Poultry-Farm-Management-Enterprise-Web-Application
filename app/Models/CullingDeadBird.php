<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 13 Aug 2018 15:55:10 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CullingDeadBird
 * 
 * @property int $id
 * @property int $farm_id
 * @property int $batch_id
 * @property string $number_of_birds
 * @property string $reason
 * @property int $pen_house_id
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
class CullingDeadBird extends Eloquent
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
		'batch_id',
		'number_of_birds',
		'reason',
		'pen_house_id',
		'date_stocked',
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
