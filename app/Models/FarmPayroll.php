<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 24 Aug 2018 09:22:14 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class FarmPayroll
 * 
 * @property int $id
 * @property int $farm_id
 * @property int $employee_id
 * @property float $amount
 * @property float $date_received
 * @property int $created_by
 * @property int $updated_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\User $user
 * @property \App\Models\Employee $employee
 * @property \App\Models\FarmAccount $farm_account
 *
 * @package App\Models
 */
class FarmPayroll extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'farm_payroll';

	protected $casts = [
		'farm_id' => 'int',
		'employee_id' => 'int',
		'amount' => 'float',
		'date_received' => 'float',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'farm_id',
		'employee_id',
		'amount',
		'date_received',
		'created_by',
		'updated_by'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'updated_by');
	}

	public function employee()
	{
		return $this->belongsTo(\App\Models\Employee::class);
	}

	public function farm_account()
	{
		return $this->belongsTo(\App\Models\FarmAccount::class, 'farm_id');
	}
}
