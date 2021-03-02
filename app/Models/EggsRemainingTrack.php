<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 12 Jul 2018 21:21:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class EggsRemainingTrack
 * 
 * @property int $id
 * @property int $farm_id
 * @property string $good_eggs
 * @property string $broken_eggs
 * @property int $updated_by
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\User $user
 * @property \App\Models\FarmAccount $farm_account
 *
 * @package App\Models
 */
class EggsRemainingTrack extends Eloquent
{
	use SoftDeletes;
	protected $table = 'eggs_remaining_track';

	protected $casts = [
		'farm_id' => 'int',
		'updated_by' => 'int',
		'created_by' => 'int'
	];

	protected $fillable = [
		'farm_id',
		'good_eggs',
		'broken_eggs',
		'updated_by',
		'created_by'
	];

	public function user()
	{
		return $this->belongsTo(\App\User::class, 'updated_by');
	}

	public function farm_account()
	{
		return $this->belongsTo(\App\Models\FarmAccount::class, 'farm_id');
	}
}
