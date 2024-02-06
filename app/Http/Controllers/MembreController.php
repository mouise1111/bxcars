<?php

namespace App\Http\Controllers;

use App\Models\Membre;
use Illuminate\Http\Request;

class MembreController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function about()
    {
        $membres = Membre::all();
        return view('about', compact('membres'));
    }

    public function index()
    {
        $membres = Membre::all();
        return view('membres', compact('membres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('membres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'fonction' => 'required|string|max:255',
            'language' => 'required|string',
        ]);

        $membre = new Membre();
        $membre->nom = $request->nom;
        $membre->fonction = $request->fonction;
        $membre->language = $request->language;
        $membre->save();


        return redirect()->route('membres.index')->with('success', 'Membre ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $membre = Membre::findOrFail($id);
        return view('membres.edit', compact('membre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $membre = Membre::findOrFail($id);
        $membre->update($request->all());

        return redirect()->route('membres.index')->with('success', 'Membre modifié avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $membre = Membre::findOrFail($id);
        $membre->delete();

        return redirect()->route('membres.index')->with('success', 'Membre supprimé avec succès');
    }
}
