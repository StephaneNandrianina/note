<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Matiere;
use App\Models\NoteMatiere;
use App\Models\Promotion;
use Illuminate\Http\Request;

class AleaController extends Controller
{
    public function selectall(){
        $promotions = Promotion::all();
        $matieres = Matiere::all();
        return view('profilAdmin.pageSaisiNote', compact('promotions','matieres'));
    }

    public function insertForMatiereAndPromotion(Request $request)
{
    
    // Valider les données
    $request->validate([
        'matiere' => 'required',
        'promotion' => 'required',
        'note' => 'required',
    ]);

    // Récupérer le codmatiere de la matière sélectionnée
    $matiere = Matiere::find($request->input('matiere'));
    
    if (!$matiere) {
        return redirect()->route('montrer.saisinote')->with('error', 'Matière non trouvée.');
    }

    // Récupérer les étudiants dans la promotion spécifiée
    $etudiants = Etudiant::where('idpromotion', $request->input('promotion'))->get();
    
    foreach ($etudiants as $etudiant) {
        
        // Insérer les données dans la table notematiere pour chaque étudiant
        NoteMatiere::create([
            'idmatiere' => $matiere->idmatiere,
            'idetudiant' => $etudiant->idetudiant,
            'note' => $request->input('note'),
            'codmatiere' => $matiere->codematiere, // Utilisez le codmatiere récupéré
        ]);
    }
    
    return redirect()->route('montrer.saisinote')->with('success', 'Notes ajoutées avec succès pour tous les étudiants de la promotion!');
    
}
 
}
