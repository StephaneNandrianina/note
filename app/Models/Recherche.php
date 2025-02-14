<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recherche extends Model
{
    use HasFactory;

    protected $table = 'v_filtreetudiant';
    protected $fillable = ['numetu','nom','prenom','datedenaissance','idpromotion','nompromotion'];
    public $timestamps = false; 

    public function rechercheSimple($mot,$promotion){
     $requete = Recherche::select('*')->where('nom','LIKE','%'.$mot.'%')
        ->Where('idpromotion',$promotion)->get()
        ;
        return $requete;
    }


}
