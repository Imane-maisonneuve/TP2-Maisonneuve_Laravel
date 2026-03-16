<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Etudiant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersFromEtudiantsSeeder extends Seeder
{
    public function run(): void
    {
        $etudiants = Etudiant::all();

        foreach ($etudiants as $etudiant) {

            User::create([
                'name' => $etudiant->nom,
                'email' => $etudiant->email,
                'password' => Hash::make('123456'),
                'etudiant_id' => $etudiant->id,
            ]);
        }
    }
}
