<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

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
        if (!$this->image) {
            return asset('images/default-car.jpg');
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        if (str_starts_with($this->image, 'images/')) {
            return asset($this->image);
        }

        if (str_starts_with($this->image, 'cars/')) {
            return asset('images/' . $this->image);
        }

        return Storage::disk('public')->url($this->image);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function calculateTotalPrice($pickupDate, $dropoffDate)
    {
        $days = Carbon::parse($pickupDate)->diffInDays(Carbon::parse($dropoffDate));
        return $this->price_per_day * $days;
    }
}
