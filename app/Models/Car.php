<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'model_name',
        'price_per_day',
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
            return asset('storage/cars/' . $this->photo);
        }

        return null; // Ou un chemin vers une image par défaut
    }
    use HasFactory;
}
