<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // S'assurer que cette ligne est présente
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'Yassine Fateh',
            'email' => 'cherradiyassine@hotmail.fr',
            'password' => Hash::make('Yassin123.'), // N'oubliez pas d'importer Hash avec use Illuminate\Support\Facades\Hash;
        ]);
    }
}
