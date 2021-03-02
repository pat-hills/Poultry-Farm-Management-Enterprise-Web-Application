<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 12 Jul 2018 21:21:37 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class IncomeCategory
 * 
 * @property int $id
 * @property string $income_category
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\User $user
 *
 * @package App\Models
 */
class IncomeCategory extends Eloquent
{
	use SoftDeletes;
	protected $table = 'income_category';

	protected $casts = [
		'created_by' => 'int'
	];

	protected $fillable = [
		'income_category',
		'created_by'
	];

	public function user()
	{
		return $this->belongsTo(\App\User::class, 'created_by');
	}
}
