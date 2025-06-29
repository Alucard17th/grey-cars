<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //

    protected $guarded = [];
    protected $casts = [
        'pickup_date' => 'date',
        'dropoff_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'extras' => 'array',
        'options' => 'array',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
