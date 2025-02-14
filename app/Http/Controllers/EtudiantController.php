<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Matiere;
use App\Models\MatiereSemestre;
use App\Models\Semestre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EtudiantController extends Controller
{
    public function test(){
       return view('profilEtudiant.test') ;
    }

    public function versLoginEtu(){
        return view('profilEtudiant.loginEtudiant');
    }

    public function login(Request $request){
        $numEtudiant = $request->input('etu');
        

        $etuInstance = new Etudiant();

        $etu = $etuInstance->login($numEtudiant);

        
        if(is_null($etu)){
            return redirect()->back()->withErrors([
                'errorLogin' => 'Invalide numero telephone .'
             ])->onlyInput('numetu');
        }
        session()->put('etudiant',$etu->idetudiant);
        session()->put('name',$etu->numetu);

        return to_route('listesemestre.l');
    }

    public function listeSemestre(){
        $proprietaireInstance = new Etudiant();
        $idetudiant = session()->get('etudiant');
        $listeSemestres = $proprietaireInstance->getBienById($idetudiant);
        return view('profilEtudiant.listeSemestre',compact('listeSemestres'));
    }

//     public function listeMatieresAjounees($etudiantId, $semestreId)
// {
//     // Récupérer les valeurs de configuration
//     $configurations = DB::table('configurationnote')->pluck('valeur', 'code');
    
//     if (!isset($configurations['CONF1']) || !isset($configurations['CONF2']) || !isset($configurations['CONF3'])) {
//         return redirect()->back()->with('error', 'Les configurations CONF1, CONF2 et CONF3 sont requises.');
//     }

//     $conf1 = $configurations['CONF1']; // Seuil pour ajournement
//     $conf2 = $configurations['CONF2']; // Nombre de matières max pour compensation
//     $conf3 = $configurations['CONF3']; // Mode de calcul des notes pour une matière avec plusieurs examens

//     $etudiant = DB::table('etudiant')->where('idetudiant', $etudiantId)->first();
//     $matieresSemestre = MatiereSemestre::where('idsemestre', $semestreId)->get();

//     if ($matieresSemestre->isEmpty()) {
//         return redirect()->back()->with('error', 'Aucune matière trouvée pour ce semestre.');
//     }

//     // Liste des matières pour le semestre
//     $matiereIds = $matieresSemestre->pluck('idmatiere');

//     // Calcul des notes selon la configuration CONF3
//     $notesQuery = DB::table('notematiere')
//         ->select('idetudiant', 'idmatiere', DB::raw(($conf3 == 1 ? 'MAX' : 'AVG') . '(note) as valeur'))
//         ->where('idetudiant', $etudiantId)
//         ->whereIn('idmatiere', $matiereIds)
//         ->groupBy('idetudiant', 'idmatiere');

//     $notes = $notesQuery->get()->map(function ($note) {
//         $note->valeur = number_format($note->valeur, 2);
//         return $note;
//     });

//     // Obtenir les matières et leurs crédits
//     $matieres = DB::table('matiere')
//         ->join('matieresemestre', 'matiere.idmatiere', '=', 'matieresemestre.idmatiere')
//         ->whereIn('matiere.idmatiere', $matiereIds)
//         ->get();

//     // Calculer les meilleures notes
//     $bestNotes = collect();

//     // Filtrer pour obtenir les matières ajournées
//     foreach ($matieres as $matiere) {
//         $note = $notes->firstWhere('idmatiere', $matiere->idmatiere);
//         if ($note && $note->valeur < $conf1) {
//             $bestNotes->push($note);
//         }
//     }

//     // Si aucune matière ajournée n'est trouvée, renvoyer un message
//     if ($bestNotes->isEmpty()) {
//         return redirect()->back()->with('error', 'Aucune matière ajournée trouvée pour cet étudiant et ce semestre.');
//     }

//     return view('profilEtudiant.listeMatieresAjounees', [
//         'etudiant' => $etudiant,
//         'notesAjounees' => $bestNotes,
//         'matieres' => $matieres
//     ]);
// }

    
}
