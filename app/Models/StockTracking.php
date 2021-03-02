<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 14 Aug 2018 08:37:12 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class StockTracking
 * 
 * @property int $id
 * @property int $batch_id
 * @property int $farm_id
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\User $user
 * @property \App\Models\FarmAccount $farm_account
 * @property \Illuminate\Database\Eloquent\Collection $culling_dead_birds
 * @property \Illuminate\Database\Eloquent\Collection $eggs_remaining_tracks
 * @property \Illuminate\Database\Eloquent\Collection $expenses
 * @property \Illuminate\Database\Eloquent\Collection $farm_eggs
 * @property \Illuminate\Database\Eloquent\Collection $farm_payable_payments
 * @property \Illuminate\Database\Eloquent\Collection $farm_payables
 * @property \Illuminate\Database\Eloquent\Collection $farm_sales
 * @property \Illuminate\Database\Eloquent\Collection $incomes
 * @property \Illuminate\Database\Eloquent\Collection $pen_house_stockings
 *
 * @package App\Models
 */
class StockTracking extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'stock_tracking';

	protected $casts = [
		'batch_id' => 'int',
		'farm_id' => 'int',
		'created_by' => 'int'
	];

	protected $fillable = [
		'batch_id',
		'farm_id',
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

	public function culling_dead_birds()
	{
		return $this->hasMany(\App\Models\CullingDeadBird::class, 'batch_id');
	}

	public function eggs_remaining_tracks()
	{
		return $this->hasMany(\App\Models\EggsRemainingTrack::class, 'batch_id');
	}

	public function expenses()
	{
		return $this->hasMany(\App\Models\Expense::class, 'batch_id');
	}

	public function farm_eggs()
	{
		return $this->hasMany(\App\Models\FarmEgg::class, 'batch_id');
	}

	public function farm_payable_payments()
	{
		return $this->hasMany(\App\Models\FarmPayablePayment::class, 'batch_id');
	}

	public function farm_payables()
	{
		return $this->hasMany(\App\Models\FarmPayable::class, 'batch_id');
	}

	public function farm_sales()
	{
		return $this->hasMany(\App\Models\FarmSale::class, 'batch_id');
	}

	public function incomes()
	{
		return $this->hasMany(\App\Models\Income::class, 'batch_id');
	}

	public function pen_house_stockings()
	{
		return $this->hasMany(\App\Models\PenHouseStocking::class, 'batch_id');
	}
}
