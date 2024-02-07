<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        $data = $request->all();

        Mail::to('ajarinawfel1@gmail.com')->send(new ContactMail($data));

        return back()->with('success', 'Votre message a été envoyé avec succès!');
    }

    public function create()
    {
        return view('emails.contact'); // Assurez-vous que le chemin de la vue est correct.
    }
}
