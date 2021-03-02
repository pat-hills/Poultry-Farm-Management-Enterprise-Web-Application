<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 23 Jul 2018 16:33:48 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Vendor
 * 
 * @property int $id
 * @property int $farm_id
 * @property string $name
 * @property string $contact
 * @property string $email
 * @property string $location
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\User $user
 * @property \App\Models\FarmAccount $farm_account
 * @property \Illuminate\Database\Eloquent\Collection $farm_feeds
 * @property \Illuminate\Database\Eloquent\Collection $farm_payables
 * @property \Illuminate\Database\Eloquent\Collection $farm_payments
 * @property \Illuminate\Database\Eloquent\Collection $pen_house_stockings
 *
 * @package App\Models
 */
class Vendor extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'vendor';

	protected $casts = [
		'farm_id' => 'int',
		'created_by' => 'int'
	];

	protected $fillable = [
		'farm_id',
		'name',
		'contact',
		'email',
		'location',
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

	public function farm_feeds()
	{
		return $this->hasMany(\App\Models\FarmFeed::class);
	}

	public function farm_payables()
	{
		return $this->hasMany(\App\Models\FarmPayable::class);
	}

	public function farm_payments()
	{
		return $this->hasMany(\App\Models\FarmPayment::class);
	}

	public function pen_house_stockings()
	{
		return $this->hasMany(\App\Models\PenHouseStocking::class);
	}
}
