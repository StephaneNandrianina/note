<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatabaseResetController extends Controller
{
    public function resetDatabase()
    {
        try {
            // Appel de la fonction SQL pour réinitialiser la base de données
            DB::statement('SELECT reinitialisation()');

            return redirect()->back()->with('success', 'La base de données a été réinitialisée avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la réinitialisation de la base de données: ' . $e->getMessage());
        }
    }
}
