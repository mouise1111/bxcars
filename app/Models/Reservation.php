<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['first_name', 'last_name', 'phone', 'email', 'pickup_location', 'start_date', 'end_date', 'car_id', 'status'];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }
    use HasFactory;
}
