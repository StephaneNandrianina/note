<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admin';
    protected $primaryKey = 'idAdmin';
    public $timestamps = false;
    protected $fillable = ['nom', 'login', 'password'];


    public function login($login,$pwd){
        $admin = Admin::where('login',$login)->where('password',$pwd)->first();
        return $admin;
    }

    public function getEtudiantAndSemestre($etudiant,$semestre){
        $releve = DB::table('v_vaovao')->where('idetudiant',$etudiant)->where('idsemestre',$semestre)->get();
        return $releve;
    }

    public function verificationNoteMaxOptionnel ($identifiant ,$tableau = []){
        
        foreach ($tableau as $table) {
            if ($table->identifiant == $identifiant ) {
                return true;
            }
        }
        return false;
    }

    public function verificationIfExistInTableau($idsemestre , $idetudiant){
        $getEtudiantAndSemestre = $this->getEtudiantAndSemestre($idsemestre , $idetudiant);
        $data = [];
        foreach ($getEtudiantAndSemestre as $table) {
            $verif = $this-> verificationNoteMaxOptionnel($table->identifiant , $data);
            if($verif == false){
                $data []= $table;

            }
        }
        return $data;
}

    
}
