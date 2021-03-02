<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 23 Aug 2018 18:46:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Employee
 * 
 * @property int $id
 * @property int $farm_id
 * @property string $first_name
 * @property string $last_name
 * @property string $secondary_contact
 * @property string $primary_contact
 * @property string $email
 * @property string $residence
 * @property string $employment_type
 * @property string $region
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property float $salary
 * 
 * @property \App\Models\User $user
 * @property \App\Models\FarmAccount $farm_account
 * @property \Illuminate\Database\Eloquent\Collection $farm_payrolls
 *
 * @package App\Models
 */
class Employee extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'employee';

	protected $casts = [
		'farm_id' => 'int',
		'created_by' => 'int',
		'salary' => 'float'
	];

	protected $fillable = [
		'farm_id',
		'first_name',
		'last_name',
		'secondary_contact',
		'primary_contact',
		'email',
		'residence',
		'employment_type',
		'region',
		'created_by',
		'salary'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'created_by');
	}

	public function farm_account()
	{
		return $this->belongsTo(\App\Models\FarmAccount::class, 'farm_id');
	}

	public function farm_payrolls()
	{
		return $this->hasMany(\App\Models\FarmPayroll::class);
	}
}
