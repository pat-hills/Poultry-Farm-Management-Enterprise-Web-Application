<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 12 Jul 2018 21:21:36 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FarmAccount
 * 
 * @property int $id
 * @property string $farm_code
 * @property int $parent_farm_id
 * @property string $farm_name
 * @property string $country_code
 * @property string $farm_contact_one
 * @property string $farm_contact_two
 * @property string $farm_contact_one_intl
 * @property string $farm_contact_two_intl
 * @property string $bank
 * @property string $location
 * @property string $email
 * @property string $farm_address
 * @property string $country
 * @property string $currency
 * @property \Carbon\Carbon $date_farm_established
 * @property string $farm_capacity
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\User $user
 * @property \Illuminate\Database\Eloquent\Collection $account_categories
 * @property \Illuminate\Database\Eloquent\Collection $assets
 * @property \Illuminate\Database\Eloquent\Collection $broken_stock_eggs
 * @property \Illuminate\Database\Eloquent\Collection $culling_dead_birds
 * @property \Illuminate\Database\Eloquent\Collection $customers
 * @property \Illuminate\Database\Eloquent\Collection $eggs_remaining_tracks
 * @property \Illuminate\Database\Eloquent\Collection $employees
 * @property \Illuminate\Database\Eloquent\Collection $expenses
 * @property \Illuminate\Database\Eloquent\Collection $farm_drugs
 * @property \Illuminate\Database\Eloquent\Collection $farm_drugs_recordings
 * @property \Illuminate\Database\Eloquent\Collection $farm_eggs
 * @property \Illuminate\Database\Eloquent\Collection $farm_feeds
 * @property \Illuminate\Database\Eloquent\Collection $farm_feed_recordings
 * @property \Illuminate\Database\Eloquent\Collection $farm_owings
 * @property \Illuminate\Database\Eloquent\Collection $farm_payables
 * @property \Illuminate\Database\Eloquent\Collection $farm_payments
 * @property \Illuminate\Database\Eloquent\Collection $farm_payrolls
 * @property \Illuminate\Database\Eloquent\Collection $farm_sales
 * @property \Illuminate\Database\Eloquent\Collection $farm_users
 * @property \Illuminate\Database\Eloquent\Collection $good_eggs_stocks
 * @property \Illuminate\Database\Eloquent\Collection $incomes
 * @property \Illuminate\Database\Eloquent\Collection $login_logs
 * @property \Illuminate\Database\Eloquent\Collection $payables_categories
 * @property \Illuminate\Database\Eloquent\Collection $pen_houses
 * @property \Illuminate\Database\Eloquent\Collection $pen_house_stockings
 * @property \Illuminate\Database\Eloquent\Collection $sales_details
 * @property \Illuminate\Database\Eloquent\Collection $stock_trackings
 * @property \Illuminate\Database\Eloquent\Collection $subscriptions
 * @property \Illuminate\Database\Eloquent\Collection $subscription_payments
 * @property \Illuminate\Database\Eloquent\Collection $vendors
 *
 * @package App\Models
 */
class FarmAccount extends Eloquent
{
	use SoftDeletes;
	protected $table = 'farm_account';

	protected $casts = [
		'parent_farm_id' => 'int',
		'created_by' => 'int'
	];

	protected $dates = [
		'date_farm_established'
	];

	protected $fillable = [
		'farm_code',
		'parent_farm_id',
		'farm_name',
		'country_code',
		'farm_contact_one',
		'farm_contact_two',
		'farm_contact_one_intl',
		'farm_contact_two_intl',
		'bank',
		'location',
		'email',
		'farm_address',
		'country',
		'currency',
		'date_farm_established',
		'farm_capacity',
		'created_by'
	];

	public function user()
	{
		return $this->belongsTo(\App\User::class, 'created_by');
	}

	public function account_categories()
	{
		return $this->hasMany(\App\Models\AccountCategory::class, 'farm_id');
	}

	public function assets()
	{
		return $this->hasMany(\App\Models\Asset::class, 'farm_id');
	}

	public function broken_stock_eggs()
	{
		return $this->hasMany(\App\Models\BrokenStockEgg::class, 'farm_id');
	}

	public function culling_dead_birds()
	{
		return $this->hasMany(\App\Models\CullingDeadBird::class, 'farm_id');
	}

	public function customers()
	{
		return $this->hasMany(\App\Models\Customer::class, 'farm_id');
	}

	public function eggs_remaining_tracks()
	{
		return $this->hasMany(\App\Models\EggsRemainingTrack::class, 'farm_id');
	}

	public function employees()
	{
		return $this->hasMany(\App\Models\Employee::class, 'farm_id');
	}

	public function expenses()
	{
		return $this->hasMany(\App\Models\Expense::class, 'farm_id');
	}

	public function farm_drugs()
	{
		return $this->hasMany(\App\Models\FarmDrug::class, 'farm_id');
	}

	public function farm_drugs_recordings()
	{
		return $this->hasMany(\App\Models\FarmDrugsRecording::class, 'farm_id');
	}

	public function farm_eggs()
	{
		return $this->hasMany(\App\Models\FarmEgg::class, 'farm_id');
	}

	public function farm_feeds()
	{
		return $this->hasMany(\App\Models\FarmFeed::class, 'farm_id');
	}

	public function farm_feed_recordings()
	{
		return $this->hasMany(\App\Models\FarmFeedRecording::class, 'farm_id');
	}

	public function farm_owings()
	{
		return $this->hasMany(\App\Models\FarmOwing::class, 'farm_id');
	}

	public function farm_payables()
	{
		return $this->hasMany(\App\Models\FarmPayable::class, 'farm_id');
	}

	public function farm_payments()
	{
		return $this->hasMany(\App\Models\FarmPayment::class, 'farm_id');
	}

	public function farm_payrolls()
	{
		return $this->hasMany(\App\Models\FarmPayroll::class, 'farm_id');
	}

	public function farm_sales()
	{
		return $this->hasMany(\App\Models\FarmSale::class, 'farm_id');
	}

	public function farm_users()
	{
		return $this->hasMany(\App\Models\FarmUser::class, 'farm_id');
	}

	public function good_eggs_stocks()
	{
		return $this->hasMany(\App\Models\GoodEggsStock::class, 'farm_id');
	}

	public function incomes()
	{
		return $this->hasMany(\App\Models\Income::class, 'farm_id');
	}

	public function login_logs()
	{
		return $this->hasMany(\App\Models\LoginLog::class, 'farm_id');
	}

	public function payables_categories()
	{
		return $this->hasMany(\App\Models\PayablesCategory::class, 'farm_id');
	}

	public function pen_houses()
	{
		return $this->hasMany(\App\Models\PenHouse::class, 'farm_id');
	}

	public function pen_house_stockings()
	{
		return $this->hasMany(\App\Models\PenHouseStocking::class, 'farm_id');
	}

	public function sales_details()
	{
		return $this->hasMany(\App\Models\SalesDetail::class, 'farm_id');
	}

	public function stock_trackings()
	{
		return $this->hasMany(\App\Models\StockTracking::class, 'farm_id');
	}

	public function subscriptions()
	{
		return $this->hasMany(\App\Models\Subscription::class, 'farm_id');
	}

	public function subscription_payments()
	{
		return $this->hasMany(\App\Models\SubscriptionPayment::class, 'farm_id');
	}

	public function vendors()
	{
		return $this->hasMany(\App\Models\Vendor::class, 'farm_id');
	}
}
