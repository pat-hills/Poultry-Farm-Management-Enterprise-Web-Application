<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 12 Jul 2018 21:21:37 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class LoginLog
 * 
 * @property int $id
 * @property int $farm_id
 * @property int $user_id
 * @property string $success
 * @property \Carbon\Carbon $login_time
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\FarmAccount $farm_account
 * @property \App\User $user
 *
 * @package App\Models
 */
class LoginLog extends Eloquent
{
	use SoftDeletes;
	protected $casts = [
		'farm_id' => 'int',
		'user_id' => 'int'
	];

	protected $dates = [
		'login_time'
	];

	protected $fillable = [
		'farm_id',
		'user_id',
		'success',
		'login_time'
	];

	public function farm_account()
	{
		return $this->belongsTo(\App\Models\FarmAccount::class, 'farm_id');
	}

	public function user()
	{
		return $this->belongsTo(\App\User::class);
	}
}
