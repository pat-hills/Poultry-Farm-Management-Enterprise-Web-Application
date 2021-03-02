<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 16 Jul 2018 11:51:36 +0000.
 */

namespace App\Models;

use App\Events\PenHouseEvent;
use Illuminate\Database\Eloquent\SoftDeletes;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PenHouse
 *
 * @property int $id
 * @property int $farm_id
 * @property string $pen_name
 * @property string $pen_number
 * @property string $stocked
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \App\User $user
 * @property \App\Models\FarmAccount $farm_account
 * @property \Illuminate\Database\Eloquent\Collection $culling_dead_birds
 * @property \Illuminate\Database\Eloquent\Collection $farm_drugs_recordings
 * @property \Illuminate\Database\Eloquent\Collection $farm_eggs
 * @property \Illuminate\Database\Eloquent\Collection $farm_feed_recordings
 * @property \Illuminate\Database\Eloquent\Collection $pen_house_stockings
 * @property \Illuminate\Database\Eloquent\Collection $sales_details
 *
 * @package App\Models
 */
class PenHouse extends Eloquent
{
    use SoftDeletes;
    protected $table = 'pen_house';

    protected $casts = [
        'farm_id' => 'int',
        'created_by' => 'int',
    ];

    protected $fillable = [
        'farm_id',
        'pen_name',
        'pen_number',
        'stocked',
        'created_by',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'deleted' => PenHouseEvent::class, 
    ];

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'created_by');
    }

    public function farm_account()
    {
        return $this->belongsTo(\App\Models\FarmAccount::class, 'farm_id');
    }

    public function culling_dead_birds()
    {
        return $this->hasMany(\App\Models\CullingDeadBird::class);
    }

    public function farm_drugs_recordings()
    {
        return $this->hasMany(\App\Models\FarmDrugsRecording::class);
    }

    public function farm_eggs()
    {
        return $this->hasMany(\App\Models\FarmEgg::class);
    }

    public function farm_feed_recordings()
    {
        return $this->hasMany(\App\Models\FarmFeedRecording::class);
    }

    public function pen_house_stockings()
    {
        return $this->hasMany(\App\Models\PenHouseStocking::class);
    }

    public function sales_details()
    {
        return $this->hasMany(\App\Models\SalesDetail::class);
    }
}
