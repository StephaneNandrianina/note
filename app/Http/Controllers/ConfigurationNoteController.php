<?php

namespace App\Http\Controllers;

use App\Models\ConfigurationNote;
use Illuminate\Http\Request;

class ConfigurationNoteController extends Controller
{
    public function index()
    {
        // Récupérer toutes les données de la table configurationnote
        $configurationNotes = ConfigurationNote::all();

        // Retourner la vue avec les données
        return view('profilAdmin.configurationnote', compact('configurationNotes'));
    }

    public function update(Request $request, $id)
    {
        // Valider la requête
        $request->validate([
            'valeur' => 'required|numeric', // Validation que la valeur est un nombre
        ]);

        // Récupérer la configuration par ID et mettre à jour la valeur
        $configurationNote = ConfigurationNote::findOrFail($id);
        $configurationNote->valeur = $request->valeur;
        $configurationNote->save();

        // Rediriger avec un message de succès
        return redirect()->route('configurerNote')->with('success', 'Configuration mise à jour avec succès');
    }
}
