<?php

namespace App\Http\Controllers;

use App\Models\MoyenneEtudiantSemestre;
use Illuminate\Http\Request;

class MoyenneEtudiantSemestreController extends Controller
{
    public function moyenne(string $idetudiant, int $idsemestre)
    {
        $instanceMoyenne = new MoyenneEtudiantSemestre();
        $moyenne = $instanceMoyenne->getMoyenneParSemestreEtEtudiant($idsemestre, $idetudiant);

        return view('listeSemestre', compact('moyenne'));
    }
}
