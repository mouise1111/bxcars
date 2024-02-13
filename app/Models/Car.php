<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Car extends Model
{
    protected $fillable = [
        'model_name',
        'price_per_day_short_term',
        'price_per_day_long_term',
        'price_caution',
        'total_km',
        'transmission',
        'seats',
        'fuel_type',
        'photo',
        'disponible',

    ];

    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            return asset('public/cars/' . $this->photo);
        }

        return null;
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function isAvailableToday()
    {
        $today = Carbon::today()->format('Y-m-d');
        return !$this->reservations()
            ->where('status', '=', 'accepted')
            ->where(function ($query) use ($today) {
                $query->where('start_date', '<=', $today)
                    ->where('end_date', '>=', $today);
            })->exists(); // Utilisez exists() pour une vérification plus efficace
    }
    use HasFactory;
}
