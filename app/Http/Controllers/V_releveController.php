<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;

class V_releveController extends Controller
{
    public function releveDeNote(){
        $etudiant = new Etudiant();
        $idEtudiant = session()->get('etudiant');
        $idsemestre = 
        $releve = $etudiant->getReleveByEtudiantAndSemestre($idEtudiant,$idsemestre);
        return view('profilEtudiant/releveEtudiant',compact('releve'));
    }
}
