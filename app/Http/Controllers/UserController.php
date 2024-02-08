<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        $users = User::all(); // Récupère tous les utilisateurs
        return view('user.create', compact('users')); // Passe les utilisateurs à la vue


    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Rediriger ou afficher un message de succès
        return redirect()->route('user.create')->with('success', 'Utilisateur créé avec succès.');
    }
    public function __construct()
    {
        $this->middleware('auth'); // Assurez-vous que l'utilisateur est connecté
        // $this->middleware('isAdmin'); // Middleware personnalisé pour vérifier si l'utilisateur est admin
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.create')->with('success', 'Utilisateur supprimé avec succès.');

    }
}

