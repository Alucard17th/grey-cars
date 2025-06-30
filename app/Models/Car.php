<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Car extends Model
{
    //
    protected $guarded = [];

    protected $casts = [
        'options' => 'array',
        'extras' => 'array',
    ];

    // Accessor for the full image path
    public function getImageUrlAttribute()
    {
        return $this->image ? asset( $this->image ) : asset('images/default-car.jpg');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function isAvailable($pickupDate, $dropoffDate, $pickupTime = null, $dropoffTime = null)
    {
        return !$this->reservations()
            ->where(function($query) use ($pickupDate, $dropoffDate) {
                $query->whereBetween('pickup_date', [$pickupDate, $dropoffDate])
                    ->orWhereBetween('dropoff_date', [$pickupDate, $dropoffDate])
                    ->orWhere(function($q) use ($pickupDate, $dropoffDate) {
                        $q->where('pickup_date', '<=', $pickupDate)
                            ->where('dropoff_date', '>=', $dropoffDate);
                    });
            })
            ->exists();
    }

    public function calculateTotalPrice($pickupDate, $dropoffDate)
    {
        $days = Carbon::parse($pickupDate)->diffInDays(Carbon::parse($dropoffDate)) + 1;
        return $this->price_per_day * $days;
    }
}
