<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class V_listeSemestre extends Model
{
    use HasFactory;
    protected $table = 'v_listesemestreetudiant';
    protected $fillable = ['idetudiant','idsemestre','nomsemestre'];
    public $timestamps = false;

    public function getSemestreEtudiant($idetudiant){
        $equipe = V_listeSemestre::where('idetudiant',$idetudiant)->get();
        return $equipe;
    }
}
