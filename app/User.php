<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword as ResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array


    //  col_farm_user_id,col_farm_users_code,col_fullname,col_pin_code,col_primary_contact,farm_contact_one_intl,col_position,col_date_created,col_date_time
     */
    protected $fillable = [
        'email', 'password', 'name','created_at','updated_at','primary_contact','country_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        // Your your own implementation.
        $this->notify(new ResetPasswordNotification($token,$this->name));
    }

    public function farm_account()
	{
		return $this->belongsTo(\App\Models\FarmAccount::class, 'farm_id');
	}

	public function account_categories()
	{
		return $this->hasMany(\App\Models\AccountCategory::class, 'created_by');
	}

	public function assets()
	{
		return $this->hasMany(\App\Models\Asset::class, 'created_by');
	}

	public function broken_stock_eggs()
	{
		return $this->hasMany(\App\Models\BrokenStockEgg::class, 'created_by');
	}

	public function culling_dead_birds()
	{
		return $this->hasMany(\App\Models\CullingDeadBird::class, 'created_by');
	}

	public function customers()
	{
		return $this->hasMany(\App\Models\Customer::class, 'created_by');
	}

	public function eggs_remaining_tracks()
	{
		return $this->hasMany(\App\Models\EggsRemainingTrack::class, 'updated_by');
	}

	public function employees()
	{
		return $this->hasMany(\App\Models\Employee::class, 'created_by');
	}

	public function expenses()
	{
		return $this->hasMany(\App\Models\Expense::class, 'created_by');
	}

	public function farm_accounts()
	{
		return $this->hasMany(\App\Models\FarmAccount::class, 'created_by');
	}

	public function farm_drugs()
	{
		return $this->hasMany(\App\Models\FarmDrug::class, 'vendor_id');
	}

	public function farm_drugs_recordings()
	{
		return $this->hasMany(\App\Models\FarmDrugsRecording::class, 'created_by');
	}

	public function farm_eggs()
	{
		return $this->hasMany(\App\Models\FarmEgg::class, 'created_by');
	}

	public function farm_feeds()
	{
		return $this->hasMany(\App\Models\FarmFeed::class, 'created_by');
	}

	public function farm_feed_recordings()
	{
		return $this->hasMany(\App\Models\FarmFeedRecording::class, 'created_by');
	}

	public function farm_owings()
	{
		return $this->hasMany(\App\Models\FarmOwing::class, 'created_by');
	}

	public function farm_payables()
	{
		return $this->hasMany(\App\Models\FarmPayable::class, 'created_by');
	}

	public function farm_payments()
	{
		return $this->hasMany(\App\Models\FarmPayment::class, 'created_by');
	}

	public function farm_payrolls()
	{
		return $this->hasMany(\App\Models\FarmPayroll::class, 'updated_by');
	}

	public function farm_sales()
	{
		return $this->hasMany(\App\Models\FarmSale::class, 'created_by');
	}

	public function farm_users()
	{
		return $this->hasMany(\App\Models\FarmUser::class, 'created_by');
	}

	public function good_eggs_stocks()
	{
		return $this->hasMany(\App\Models\GoodEggsStock::class, 'created_by');
	}

	public function incomes()
	{
		return $this->hasMany(\App\Models\Income::class, 'created_by');
	}

	public function income_categories()
	{
		return $this->hasMany(\App\Models\IncomeCategory::class, 'created_by');
	}

	public function login_logs()
	{
		return $this->hasMany(\App\Models\LoginLog::class);
	}

	public function payables_categories()
	{
		return $this->hasMany(\App\Models\PayablesCategory::class, 'created_by');
	}

	public function pen_houses()
	{
		return $this->hasMany(\App\Models\PenHouse::class, 'created_by');
	}

	public function pen_house_stockings()
	{
		return $this->hasMany(\App\Models\PenHouseStocking::class, 'created_by');
	}

	public function sales_details()
	{
		return $this->hasMany(\App\Models\SalesDetail::class, 'created_by');
	}

	public function stock_trackings()
	{
		return $this->hasMany(\App\Models\StockTracking::class, 'created_by');
	}

	public function subscriptions()
	{
		return $this->hasMany(\App\Models\Subscription::class, 'updated_by');
	}

	public function subscription_payments()
	{
		return $this->hasMany(\App\Models\SubscriptionPayment::class, 'paid_by');
	}

	public function subscription_plans()
	{
		return $this->hasMany(\App\Models\SubscriptionPlan::class, 'created_by');
	}

	public function vendors()
	{
		return $this->hasMany(\App\Models\Vendor::class, 'created_by');
	}
}
