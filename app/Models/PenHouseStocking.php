<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 14 Aug 2018 08:37:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PenHouseStocking
 * 
 * @property int $id
 * @property int $farm_id
 * @property int $batch_id
 * @property int $farm_payables_id
 * @property string $number_of_stock
 * @property string $type_of_bird
 * @property int $pen_house_id
 * @property string $penhouse_identity
 * @property string $description
 * @property int $vendor_id
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\StockTracking $stock_tracking
 * @property \App\Models\User $user
 * @property \App\Models\FarmAccount $farm_account
 * @property \App\Models\FarmPayable $farm_payable
 * @property \App\Models\PenHouse $pen_house
 * @property \App\Models\Vendor $vendor
 *
 * @package App\Models
 */
class PenHouseStocking extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'pen_house_stocking';

	protected $casts = [
		'farm_id' => 'int',
		'batch_id' => 'int',
		'farm_payables_id' => 'int',
		'pen_house_id' => 'int',
		'vendor_id' => 'int',
		'created_by' => 'int'
	];

	protected $fillable = [
		'farm_id',
		'batch_id',
		'farm_payables_id',
		'number_of_stock',
		'type_of_bird',
		'pen_house_id',
		'penhouse_identity',
		'description',
		'vendor_id',
		'created_by',
		'date_stocked'
		
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

	public function farm_payable()
	{
		return $this->belongsTo(\App\Models\FarmPayable::class, 'farm_payables_id');
	}

	public function pen_house()
	{
		return $this->belongsTo(\App\Models\PenHouse::class);
	}

	public function vendor()
	{
		return $this->belongsTo(\App\Models\Vendor::class);
	}
}
