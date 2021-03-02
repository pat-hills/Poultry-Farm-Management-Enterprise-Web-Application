<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 12 Jul 2018 21:21:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Expense
 * 
 * @property int $id
 * @property int $farm_id
 * @property int $expenditure_id
 * @property string $farm_drug_id
 * @property string $batch_id
 * @property string $expense_item
 * @property string $description
 * @property string $amount_involved
 * @property string $category
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\User $user
 * @property \App\Models\FarmAccount $farm_account
 *
 * @package App\Models
 */
class Expense extends Eloquent
{
	use SoftDeletes;
	protected $casts = [
		'farm_id' => 'int',
		'expenditure_id' => 'int',
		'created_by' => 'int'
	];

	protected $fillable = [
		'farm_id',
		'expenditure_id',
		'farm_drug_id',
		'batch_id',
		'expense_item',
		'description',
		'amount_involved',
		'category',
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
