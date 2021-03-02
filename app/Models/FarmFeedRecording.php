<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 16 Aug 2018 13:53:55 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class FarmFeedRecording
 * 
 * @property int $id
 * @property int $farm_id
 * @property int $pen_house_id
 * @property string $feed_name
 * @property string $feed_frequency
 * @property string $quantity_applied
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property int $batch_id
 * @property \Carbon\Carbon $date_recorded
 * 
 * @property \App\Models\StockTracking $stock_tracking
 * @property \App\Models\User $user
 * @property \App\Models\FarmAccount $farm_account
 * @property \App\Models\PenHouse $pen_house
 *
 * @package App\Models
 */
class FarmFeedRecording extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'farm_feed_recording';

	protected $casts = [
		'farm_id' => 'int',
		'pen_house_id' => 'int',
		'created_by' => 'int',
		'batch_id' => 'int'
	];

	protected $dates = [
		'date_recorded'
	];

	protected $fillable = [
		'farm_id',
		'pen_house_id',
		'feed_name',
		'feed_frequency',
		'quantity_applied',
		'created_by',
		'batch_id',
		'date_recorded'
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
