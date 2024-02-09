<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $subjectLabels = [
            'service_client' => 'Service client',
            'support_technique' => 'Support technique - Réservation',
            'support_vehicule' => 'Support - Véhicule',
            'recrutement' => 'Recrutement',
            'autre' => 'Autre',
        ];

        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',

        ]);

        $data = $request->all();

        Mail::to('info@bxcars.be')->send(new ContactMail($data));

        return back()->with('success', 'Votre message a été envoyé avec succès!');
    }

    public function create()
    {
        return view('emails.contact'); // Assurez-vous que le chemin de la vue est correct.
    }
}
