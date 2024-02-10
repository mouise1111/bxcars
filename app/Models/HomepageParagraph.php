<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageParagraph extends Model
{
    use HasFactory;
    protected $fillable = ['content'];

    protected $table = 'homepage_paragraphs'; // Spécifiez le nom de la table ici
}
