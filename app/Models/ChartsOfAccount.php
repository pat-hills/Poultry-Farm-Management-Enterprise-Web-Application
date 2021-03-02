<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 09 Oct 2018 21:52:14 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ChartsOfAccount
 * 
 * @property int $id
 * @property int $farm_id
 * @property string $item_name
 * @property string $acc_name
 * @property string $acc_type
 * @property string $sub_category
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\User $user
 * @property \App\Models\FarmAccount $farm_account
 *
 * @package App\Models
 */
class ChartsOfAccount extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'farm_id' => 'int',
		'created_by' => 'int'
	];

	protected $fillable = [
		'farm_id',
		'item_name',
		'acc_name',
		'acc_type',
		'sub_category',
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
}
