<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 16 Aug 2018 13:54:10 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class FarmDrugsRecording
 * 
 * @property int $id
 * @property int $farm_id
 * @property string $drug_name
 * @property string $drug_device
 * @property string $quantity
 * @property string $weight
 * @property int $pen_house_id
 * @property string $drug_frequency
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
class FarmDrugsRecording extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'farm_drugs_recording';

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
		'drug_name',
		'drug_device',
		'quantity',
		'weight',
		'pen_house_id',
		'drug_frequency',
		'unit',
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
