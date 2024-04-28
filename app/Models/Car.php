<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'make',
        'model',
        'colour',
        'year',
        'transmission',
        'car_type',
        'price',
        'photo',
        'user_id'
    ];

    /**
     * Get the user that owns the car.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
