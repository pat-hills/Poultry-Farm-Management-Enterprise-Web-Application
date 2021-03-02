<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 27 Jul 2018 23:33:06 +0000.
 */

namespace App\Models;
use App\Events\FarmPayableEvent;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class FarmPayable
 *
 * @property int $id
 * @property int $farm_id
 * @property int $vendor_id
 * @property int $batch_id
 * @property string $invoice_number
 * @property string $description
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property \Carbon\Carbon $date_issued
 * @property \Carbon\Carbon $date_due
 * @property string $currency
 *
 * @property \App\Models\StockTracking $stock_tracking
 * @property \App\Models\User $user
 * @property \App\Models\FarmAccount $farm_account
 * @property \App\Models\Vendor $vendor
 * @property \Illuminate\Database\Eloquent\Collection $farm_payable_payments
 * @property \Illuminate\Database\Eloquent\Collection $farm_payables_details
 * @property \Illuminate\Database\Eloquent\Collection $pen_house_stockings
 *
 * @package App\Models
 */
class FarmPayable extends Eloquent
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $casts = [
        'farm_id' => 'int',
        'vendor_id' => 'int',
        'batch_id' => 'int',
        'created_by' => 'int',
    ];

    protected $dates = [
        'date_issued',
        'date_due',
    ];

    protected $fillable = [
        'farm_id',
        'vendor_id',
        'batch_id',
        'invoice_number',
        'description',
        'created_by',
        'date_issued',
        'date_due',
        'currency',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'deleted' => FarmPayableEvent::class, 
        'restored' => FarmPayableEvent::class,
    ];

    public function stock_tracking()
    {
        return $this->belongsTo(\App\Models\StockTracking::class, 'batch_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function farm_account()
    {
        return $this->belongsTo(\App\Models\FarmAccount::class, 'farm_id');
    }

    public function vendor()
    {
        return $this->belongsTo(\App\Models\Vendor::class);
    }

    public function farm_payable_payments()
    {
        return $this->hasMany(\App\Models\FarmPayablePayment::class);
    }

    public function farm_payables_details()
    {
        return $this->hasMany(\App\Models\FarmPayablesDetail::class, 'farm_payables_id');
    }

    public function pen_house_stockings()
    {
        return $this->hasMany(\App\Models\PenHouseStocking::class, 'farm_payables_id');
    }
}
