<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class V_releve extends Model
{
    use HasFactory;
    protected $table = 'v_releve';
    protected $fillable = ['codematiere','nommatiere','credit','notemax','idetudiant','idsemestre','moyennenote_generale','resultat'];
    public $timestamps = false;

    public function getReleveByEtudiantAndSemestre($etudiant,$semestre){
        $releve = V_releve::where('idetudiant',$etudiant)->where('idsemestre',$semestre)->get();
        return $releve;
    }


    public function verification(){
        
    }

}
