<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteMatiere extends Model
{
    use HasFactory;
    protected $table = 'notematiere';
    protected $primaryKey = 'idnotematiere';
    protected $fillable = ['idmatiere','idetudiant','note','codmatiere'];
    public $timestamps = false;

    public function ajoutNoteMatiere($matiere,$etudiant,$notes){
        try{
            NoteMatiere::CREATE([
                'idmatiere'=>$matiere,
                'idetudiant'=>$etudiant,
                'note'=>$notes
            ]);
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }

    


}
