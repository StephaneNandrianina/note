<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Etudiant;
use App\Models\Matiere;
use App\Models\MatiereSemestre;
use App\Models\MoyenneEtudiantSemestre;
use App\Models\NoteMatiere;
use App\Models\Promotion;
use App\Models\Recherche;
use App\Models\Semestre;
use App\Models\V_listeSemestre;
use App\Models\V_releve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function versLogin()
    {
        return view('profilAdmin.loginAdmin');
    }


    public function login(Request $request)
    {
        $login = $request->input('login');
        $pwd = $request->input('password');

        $equipeInstance = new Admin();
        $admin = $equipeInstance->login($login, $pwd);

        if (is_null($admin)) {
            return redirect()->back()->withErrors([
                'errorLogin' => 'Invalide email ou mot de passe.'
            ])->withInput($request->except('password'));
        }

        session()->put('utilisateur', $admin->idadmin);
        session()->put('name', $admin->login);
        session()->put('typeutilisateur', 'welcome');
        
        return redirect()->route('show.saisinote');
    }


    public function getAllEtudAndMatiere()
    {
        $etudiants = Etudiant::all();
        $matieres = Matiere::all();
        return view('profilAdmin.saisiNote', compact('etudiants','matieres'));
    }

    public function insertForMatiereAndPromotion(Request $request){
        $request->validate([
            'matiere'=> 'required',
            'promotion'=> 'required',
            'note'=>'required'
        ]);

        $promotion = $request->input('promotion');
        $matieres = $request->input('matiere');
        $notes = $request->input('note');

        $instanceNoteMatiere = new NoteMatiere();
        $instanceNoteMatiere->ajoutNoteMatiere($promotion,$matieres,$notes);

        return redirect()->route('show.saisinote');

    }

    public function getAllPromotion()
    {
        $promotions = Promotion::all();
        $listeRechercheEtudiant = [];
        return view('profilAdmin.filtrePromNom', compact('promotions','listeRechercheEtudiant'));
    }

    public function recherche(Request $request){
        $mot = $request->input('mot');
        $promotion = $request->input('promotion');
        $recherche = new Recherche();
        $promotions = Promotion::all();
        $listeRechercheEtudiant = $recherche->rechercheSimple($mot,$promotion);

        return view('profilAdmin.filtrePromNom',compact('listeRechercheEtudiant','promotions'));
    }

    // public function listeSemestre(string $idetudiant)
    // {
        
    //     $instance = new V_listeSemestre();
    //     $listeSemestres = $instance->getSemestreEtudiant($idetudiant);
    //     return view('listeSemestre', compact('listeSemestres'));
    // }

    // public function listeSemestre($etudiantId)
    // {
    //     $listeSemestres = DB::table('semestre')
    //         ->join('matieresemestre', 'semestre.idsemestre', '=', 'matieresemestre.idsemestre')
    //         ->join('matiere', 'matieresemestre.idmatiere', '=', 'matiere.idmatiere')
    //         ->join('notematiere', 'matiere.idmatiere', '=', 'notematiere.idmatiere')
    //         ->select('semestre.idsemestre', 'semestre.nomsemestre', DB::raw('AVG(notematiere.note) as moyennegenerale'))
    //         ->where('notematiere.idetudiant', $etudiantId)
    //         ->groupBy('semestre.idsemestre', 'semestre.nomsemestre')
    //         ->get();
    
    //     return view('listeSemestre', compact('listeSemestres', 'etudiantId'));
    // }
    

    public function listeSemestre($etudiantId)
{
    $listeSemestres = DB::table(DB::raw('(SELECT semestre.idsemestre, semestre.nomsemestre, 
                                              AVG(notematiere.note) as moyennegenerale,
                                              DENSE_RANK() OVER (ORDER BY AVG(notematiere.note) DESC) as rang
                                          FROM semestre
                                          JOIN matieresemestre ON semestre.idsemestre = matieresemestre.idsemestre
                                          JOIN matiere ON matieresemestre.idmatiere = matiere.idmatiere
                                          JOIN notematiere ON matiere.idmatiere = notematiere.idmatiere
                                          WHERE notematiere.idetudiant = ?
                                          GROUP BY semestre.idsemestre, semestre.nomsemestre) as ranked'))
        ->select('idsemestre', 'nomsemestre', 'moyennegenerale', 'rang')
        ->addBinding($etudiantId)
        ->get();
    
    return view('listeSemestre', compact('listeSemestres', 'etudiantId'));
}


    public function releveDeNote($idetudiant,$idsemestre){
        $adminInstance = new V_releve();
        $relev= $adminInstance->getReleveByEtudiantAndSemestre($idetudiant,$idsemestre);
        return view('profilAdmin.releveDeNote',compact('relev'));
    }

    public function logout()
    {
        session()->forget('admin');
        return redirect()->route('admin.versLogin');
    }


// public function testVerification()
//     {
//         $semestre = 4;
//         $idetudiant = 4;
//         $instance = new Admin();
//         $result = $instance->verificationIfExistInTableau($semestre, $idetudiant);

//         // Afficher le résultat pour vérifier
//         return response()->json($result);
//     }        

public function shownotesEtudiants($etudiantId, $semestreId)
{
    // Récupérer les valeurs de configuration
    $configurations = DB::table('configurationnote')->pluck('valeur', 'code');
    
    if (!isset($configurations['CONF1']) || !isset($configurations['CONF2']) || !isset($configurations['CONF3'])) {
        return [
            'error' => 'Les configurations CONF1, CONF2 et CONF3 sont requises.',
            'data' => null
        ];
    }

    $conf1 = $configurations['CONF1']; // Seuil pour ajournement
    $conf2 = $configurations['CONF2']; // Nombre de matières max pour compensation
    $conf3 = $configurations['CONF3']; // Mode de calcul des notes pour une matière avec plusieurs examens

    $etudiant = DB::table('etudiant')->where('idetudiant', $etudiantId)->first();
    $matieresSemestre = MatiereSemestre::where('idsemestre', $semestreId)->get();
    // $matieres = Matiere::where('id_semestre', $semestreId)->get();
    
    if ($matieresSemestre->isEmpty()) {
        return [
            'error' => 'Aucune matière trouvée pour ce semestre.',
            'data' => null
        ];
    }

    // Liste des matières pour le semestre
     $matiereIds = $matieresSemestre->pluck('idmatiere');
     
    // Calcul des notes selon la configuration CONF3
    if ($conf3 == 1) {
        // Prendre la note maximale pour chaque matière
          $notes = DB::table('notematiere')
            ->select('idetudiant', 'idmatiere', DB::raw('MAX(note) AS valeur'))
            ->where('idetudiant', $etudiantId)
            ->whereIn('idmatiere', $matieresSemestre->pluck('idmatiere'))
            ->groupBy('idetudiant', 'idmatiere')
            ->get();
      

    } else if ($conf3 == 2) {
        // Calculer la moyenne des notes pour chaque matière
        $notes = DB::table('notematiere')
            ->select('idetudiant', 'idmatiere', DB::raw('AVG(note) as valeur'))
            ->where('idetudiant', $etudiantId)
            ->whereIn('idmatiere', $matieresSemestre->pluck('idmatiere'))
            ->groupBy('idetudiant', 'idmatiere')
            ->get();
        
        // Formater les valeurs des notes avec 2 chiffres après la virgule
        $notes = $notes->map(function ($note) {
            $note->valeur = number_format($note->valeur, 2);
            return $note;
        });
    } else {
        return [
            'error' => 'Configuration CONF3 invalide.',
            'data' => null
        ];
    }

    // Obtenir les matières et leurs crédits
    $matieres = DB::table('matiere')
        ->join('matieresemestre', 'matiere.idmatiere', '=', 'matieresemestre.idmatiere')
        ->whereIn('matiere.idmatiere', $matiereIds)
        ->get();

    // Sélectionner les matières optionnelles
    $matieresOptionnelles = $matieres->filter(function ($matiere) {
        return !is_null($matiere->identifiant);
        
    });
    
    // Regrouper les matières optionnelles par groupe_option
    $groupedMatieresOptionnelles = $matieresOptionnelles->groupBy('identifiant');
    
    // Calculer les meilleures notes pour les groupes optionnels
    $bestNotes = collect();
    
    foreach ($groupedMatieresOptionnelles as $groupe => $matiereGroupe) {
        if ($groupe) {
            $notesForGroup = $notes->whereIn('idmatiere', $matiereGroupe->pluck('idmatiere'));
            $maxNoteValue = $notesForGroup->max('valeur');
            $bestNotesForGroup = $notesForGroup->where('valeur', $maxNoteValue);

            $bestNote = $bestNotesForGroup->count() > 1 ? $bestNotesForGroup->random() : $bestNotesForGroup->first();

            if ($bestNote) {
                $bestNotes->push($bestNote);
            } else {
                $matiere = $matiereGroupe->first();
                $bestNotes->push((object)['idmatiere' => $matiere->idmatiere, 'valeur' => 0]);
            }
        }
    }

    // Inclure les matières non-optionnelles avec les meilleures notes
    $nonOptionnelles = $matieres->filter(function ($matiere) {
        return is_null($matiere->identifiant);
    });

    foreach ($nonOptionnelles as $matiere) {
        $note = $notes->firstWhere('idmatiere', $matiere->idmatiere);
        if ($note) {
            $bestNotes->push($note);
        } else {
            $bestNotes->push((object)['idmatiere' => $matiere->idmatiere, 'valeur' => 0]);
        }
    }
    
    // Éviter les doublons dans les meilleures notes
    $bestNotes = $bestNotes->unique('idmatiere');

    // Calculer la moyenne générale
    $totalPoints = 0;
    $totalCredits = 0;
    $creditsObtenus = 0;

    foreach ($bestNotes as $note) {
        $matiere = $matieres->firstWhere('idmatiere', $note->idmatiere);
        if ($matiere) {
            $totalPoints += $note->valeur * $matiere->credit;
            $totalCredits += $matiere->credit;
            // Ajout de journalisation pour débogage
            Log::info("Calcul", ['note' => $note->valeur, 'credit' => $matiere->credit, 'totalPoints' => $totalPoints, 'totalCredits' => $totalCredits]);
        } else {
            // Vérifiez si une matière n'a pas été trouvée pour une note
            Log::warning("Matière non trouvée", ['idmatiere' => $note->idmatiere]);
        }
    }
    
    $moyenneGenerale = $totalCredits ? $totalPoints / $totalCredits : 0;
    
    
    // Déterminer les résultats des matières
    $resultats = [];
    $notesBelowConf1 = $bestNotes->filter(function ($note) use ($conf1) {
        return $note->valeur < $conf1;
    });
    
    if ($notesBelowConf1->isNotEmpty()) {
        // Si au moins une note est inférieure à CONF1
        foreach ($bestNotes as $note) {
            if ($note->valeur >= 10) {
                $resultats[$note->idmatiere] = 'valide';
                $creditsObtenus += $matieres->firstWhere('idmatiere', $note->idmatiere)->credit;
            } else {
                $resultats[$note->idmatiere] = 'ajournée';
            }
        }
    } else {
        // Appliquer la règle de compensation
        $matieresCompensees = $bestNotes->filter(function ($note) use ($conf1) {
            return $note->valeur >= $conf1 && $note->valeur < 10;
        });

        if ($matieresCompensees->count() <= $conf2 && $moyenneGenerale >= 10) {
            foreach ($bestNotes as $note) {
                if ($note->valeur >= 10) {
                    $resultats[$note->idmatiere] = 'valide';
                    $creditsObtenus += $matieres->firstWhere('idmatiere', $note->idmatiere)->credit;
                } elseif ($note->valeur >= $conf1) {
                    $resultats[$note->idmatiere] = 'compensée';
                    $creditsObtenus += $matieres->firstWhere('idmatiere', $note->idmatiere)->credit;
                } else {
                    $resultats[$note->idmatiere] = 'ajournée';
                }
            }
        } else {
            foreach ($bestNotes as $note) {
                if ($note->valeur >= 10) {
                    $resultats[$note->idmatiere] = 'valide';
                    $creditsObtenus += $matieres->firstWhere('idmatiere', $note->idmatiere)->credit;
                } else {
                    $resultats[$note->idmatiere] = 'ajournée';
                }
                
            }
        }
    }

    // Déterminer la mention
    $mention = 'admis';
    if (in_array('ajournée', $resultats) || $moyenneGenerale < 10) {
        $mention = 'ajournée';
    }
    
    return [
        'error' => null,
        'data' => [
            'moyenneGenerale' => $moyenneGenerale,
            'creditsObtenus' => $creditsObtenus,
            'bestNotes' => $bestNotes,
            'resultats' => $resultats,
            'mention' => $mention
        ]
    ];
}


    public function show($etudiantId, $semestreId)
{
    $result = $this->shownotesEtudiants($etudiantId, $semestreId);

    if ($result['error']) {
        return redirect()->back()->with('error', $result['error']);
    }
    
    $data = $result['data'];
    $etudiant = Etudiant::findOrFail($etudiantId);
    $semestre = Semestre::findOrFail($semestreId);
          
    // Récupérer les matières associées au semestre via la table `matiereSemestre`
    $matieres = DB::table('matiere')
        ->join('matieresemestre', 'matiere.idmatiere', '=', 'matieresemestre.idmatiere')
        ->where('matieresemestre.idsemestre', $semestreId)
        ->get();

    // Retourner la vue avec les données compilées
    return view('newRelever', array_merge(compact('etudiant', 'semestre', 'matieres'), $data));
}

public function afficherSemestres()
{
    // Récupérer tous les semestres depuis la base de données
    $semestres = DB::table('semestre')->get();

    // Retourner la vue avec les semestres
    return view('profilAdmin.lesSemestres', compact('semestres'));
}


public function listeEtudiantsParSemestre($semestreId)
{
    // Sous-requête pour récupérer les étudiants avec leurs moyennes
    $subquery = DB::table('etudiant')
        ->join('notematiere', 'etudiant.idetudiant', '=', 'notematiere.idetudiant')
        ->join('matieresemestre', 'notematiere.idmatiere', '=', 'matieresemestre.idmatiere')
        ->where('matieresemestre.idsemestre', $semestreId)
        ->select('etudiant.idetudiant', 'etudiant.nom', 'etudiant.prenom', DB::raw('AVG(notematiere.note) as moyenne'))
        ->groupBy('etudiant.idetudiant', 'etudiant.nom', 'etudiant.prenom');

    // Requête principale pour ajouter le rang en utilisant le DENSE_RANK()
    $etudiants = DB::table(DB::raw("({$subquery->toSql()}) as sub"))
        ->mergeBindings($subquery) // Merge les bindings pour la sous-requête
        ->select('sub.*', DB::raw('DENSE_RANK() OVER (ORDER BY moyenne DESC) as rang'))
        ->orderBy('moyenne', 'DESC')
        ->get();

    return view('profilAdmin.etudiantMoyenne', compact('etudiants', 'semestreId'));
}




public function listerMatieresAjourees()
{
    // Récupérer l'étudiant connecté depuis la session
    $etudiant = session('etudiant');
    
    // Vérifier si un étudiant est connecté
    if (!$etudiant) {
        return redirect()->back()->with('error', 'Aucun étudiant connecté.');
    }

    // Récupérer l'objet étudiant à partir de l'ID
    $etudiant = Etudiant::find($etudiant);

    // Vérifiez si l'étudiant a été trouvé
    if (!$etudiant) {
        return redirect()->back()->with('error', 'Étudiant introuvable.');
    }

    // Récupérer les valeurs de configuration
    $configurations = DB::table('configurationnote')->pluck('valeur', 'code');

    if (!isset($configurations['CONF1']) || !isset($configurations['CONF2']) || !isset($configurations['CONF3'])) {
        return redirect()->back()->with('error', 'Les configurations CONF1, CONF2 et CONF3 sont requises.');
    }

    $conf1 = $configurations['CONF1']; // Seuil pour ajournement
    $conf2 = $configurations['CONF2']; // Nombre de matières max pour compensation
    $conf3 = $configurations['CONF3']; // Mode de calcul des notes pour une matière avec plusieurs examens

    $semestres = Semestre::all();
    $matieresAjourees = collect();
    $prixRattrapageParMatiere = 25000; // Prix du rattrapage par matière
    $nombreMatieresAjourees = 0;

    foreach ($semestres as $semestre) {
        // Utilisez la fonction helper pour calculer les notes du semestre
        $result = $this->shownotesEtudiants($etudiant->idetudiant, $semestre->idsemestre);
        
        if ($result['error']) {
            // Ignorer les erreurs pour les semestres non pertinents
            continue;
        }

        $resultats = $result['data']['resultats'];
        
        foreach ($resultats as $codeMatiere => $etat) {
            
            if ($etat === 'ajournée') {
                // Récupérer la matière par son code
                $matiere = Matiere::where('codematiere', $codeMatiere)->first();
                if ($matiere) {
                    $matieresAjourees->push($matiere);
                    $nombreMatieresAjourees++;
                   
                }
            }
        }
    }
    
    // Calculer le montant total pour les rattrapages
    
    $montantTotalRattrapage = $nombreMatieresAjourees * $prixRattrapageParMatiere;

    return view('profilEtudiant.listeMatieresAjounees', compact('etudiant', 'matieresAjourees', 'montantTotalRattrapage'));
}


}