<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 12 Jul 2018 21:21:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FarmFeed
 * 
 * @property int $id
 * @property int $farm_id
 * @property string $feed_name
 * @property string $feed_price
 * @property string $quantity
 * @property float $amount
 * @property string $feed_weight
 * @property string $accumulated_weight
 * @property string $receipt_number
 * @property string $notes
 * @property int $vendor_id
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\User $user
 * @property \App\Models\FarmAccount $farm_account
 * @property \App\Models\Vendor $vendor
 *
 * @package App\Models
 */
class FarmFeed extends Eloquent
{
	use SoftDeletes;
	protected $table = 'farm_feed';

	protected $casts = [
		'farm_id' => 'int',
		'amount' => 'float',
		'vendor_id' => 'int',
		'created_by' => 'int'
	];

	protected $fillable = [
		'farm_id',
		'feed_name',
		'feed_price',
		'quantity',
		'amount',
		'feed_weight',
		'accumulated_weight',
		'receipt_number',
		'notes',
		'vendor_id',
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

	public function vendor()
	{
		return $this->belongsTo(\App\Models\Vendor::class);
	}
}
