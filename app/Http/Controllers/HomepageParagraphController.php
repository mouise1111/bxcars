<?php

namespace App\Http\Controllers;

use App\Models\HomepageParagraph;
use Illuminate\Http\Request;

class HomepageParagraphController extends Controller
{
    public function edit()
    {
        $paragraph = HomepageParagraph::latest()->first();
        return view('cars.create', compact('paragraph'));

    }

    public function update(Request $request)
    {
        $request->validate([
            'content' => 'required|string|min:1',
        ]);

        HomepageParagraph::updateOrCreate([], ['content' => $request->input('content')]);

        return back()->with('success', 'Paragraphe mis à jour avec succès.');
    }
}
