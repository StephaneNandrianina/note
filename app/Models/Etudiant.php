<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Etudiant extends Model
{
    use HasFactory;
    protected $table = 'etudiant';
    protected $primaryKey = 'idetudiant';
    protected $fillable = ['numetu','nom','prenom','datedenaissance','idpromotion','idgenre'];
    public $timestamps = false;

    public function login($numero){
        $proprietaire = Etudiant::where('numetu',$numero)->first();
        return $proprietaire;
    }

    public function getBienById($etudiant){
        $listeSemestre = DB::table('v_listesemestreetudiant')->where('idetudiant',$etudiant)->get();
        return $listeSemestre;
    }
}
