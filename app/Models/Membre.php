<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membre extends Model
{
    protected $fillable = ['nom', 'fonction', 'language'];
    use HasFactory;
}
