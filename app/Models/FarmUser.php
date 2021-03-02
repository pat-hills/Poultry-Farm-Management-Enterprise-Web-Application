<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 12 Jul 2018 21:21:37 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FarmUser
 * 
 * @property int $id
 * @property int $farm_id
 * @property string $fullname
 * @property string $primary_contact
 * @property string $pincode
 * @property string $email
 * @property string $region
 * @property string $location
 * @property string $gender
 * @property string $position
 * @property string $education
 * @property int $created_by
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\User $user
 * @property \App\Models\FarmAccount $farm_account
 *
 * @package App\Models
 */
class FarmUser extends Eloquent
{
	use SoftDeletes;
	protected $casts = [
		'farm_id' => 'int',
		'created_by' => 'int'
	];

	protected $hidden = [
		'remember_token'
	];

	protected $fillable = [
		'farm_id',
		'fullname',
		'primary_contact',
		'pincode',
		'email',
		'region',
		'location',
		'gender',
		'position',
		'education',
		'created_by',
		'remember_token'
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
