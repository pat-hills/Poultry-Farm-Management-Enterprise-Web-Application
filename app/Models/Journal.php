<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 09 Oct 2018 21:48:53 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Journal
 * 
 * @property int $id
 * @property int $farm_id
 * @property string $acc_name
 * @property string $acc_type
 * @property string $description
 * @property float $debit
 * @property float $credit
 * @property float $bal
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
class Journal extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'journal';

	protected $casts = [
		'farm_id' => 'int',
		'debit' => 'float',
		'credit' => 'float',
		'bal' => 'float',
		'created_by' => 'int'
	];

	protected $fillable = [
		'farm_id',
		'acc_name',
		'acc_type',
		'description',
		'debit',
		'credit',
		'bal',
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
