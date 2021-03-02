<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 12 Jul 2018 21:21:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AccountCategory
 * 
 * @property int $id
 * @property int $farm_id
 * @property string $type
 * @property string $name
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\User $user
 * @property \App\Models\FarmAccount $farm_account
 *
 * @package App\Models
 */
class AccountCategory extends Eloquent
{
	use SoftDeletes;
	protected $table = 'account_category';

	protected $casts = [
		'farm_id' => 'int',
		'created_by' => 'int'
	];

	protected $fillable = [
		'farm_id',
		'type',
		'name',
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
