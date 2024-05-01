<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $fillable = ['user_id', 'car_id'];

    public $timestamps = false;

    /**
     * Get the user that owns the favorite.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the car that is favorited.
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
