<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 12 Jul 2018 21:21:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Asset
 * 
 * @property int $id
 * @property int $farm_id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $date_purchased
 * @property float $amount
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\User $user
 * @property \App\Models\FarmAccount $farm_account
 *
 * @package App\Models
 */
class Asset extends Eloquent
{
	use SoftDeletes;
	protected $table = 'asset';

	protected $casts = [
		'farm_id' => 'int',
		'amount' => 'float',
		'created_by' => 'int'
	];

	protected $dates = [
		'date_purchased'
	];

	protected $fillable = [
		'farm_id',
		'name',
		'description',
		'date_purchased',
		'amount',
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
