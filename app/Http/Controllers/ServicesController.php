<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        return view('services'); // Assurez-vous que le chemin de la vue est correct.
    }
}