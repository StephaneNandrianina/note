<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ConfigurationNote extends Model
{
    use HasFactory;
    protected $table = 'configurationnote';
    protected $primaryKey = 'idconfigurationnote';
    protected $fillable = ['code','config','valeur'];
    public $timestamps = false;

    public function getIdConfigNote(){
        return ConfigurationNote::where('idconfigurationnote','=',2)->first();
    }

    public function getNoteEtudiantInsemestre($semestre, $etudiant){
        $note = DB::table('v_releve')->where('idsemestre',$semestre)->where('idetudiant',$etudiant)->get();
        return $note;
    }

    }
