<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NoteImport extends Model
{
    use HasFactory;
    protected $table = 'noteimport';
    protected $primaryKey = 'idnoteimport';
    protected $fillable = ['numetu','nom','prenom','genre','datedenaissance','promotion','codematiere','semestre','note'];
    public $timestamps = false;

    public function insertGenreInNoteImport(){
        DB::insert('INSERT INTO genre(nomgenre)
        SELECT DISTINCT nti.genre
        FROM noteimport nti
        LEFT JOIN genre g ON nti.genre = g.nomgenre
        WHERE g.nomgenre IS NULL
        ');
    }

    public function insertPromotionInNoteImport(){
        DB::insert('INSERT INTO promotion(nompromotion)
        SELECT DISTINCT nti.promotion
        FROM noteimport nti
        left JOIN promotion p ON nti.promotion = p.nompromotion
        WHERE p.nompromotion IS NULL
        ');
    }

    // public function insertSemestreInNoteImport(){
    //     DB::insert('INSERT INTO semestre(nomsemestre)
    //     SELECT DISTINCT nti.semestre
    //     FROM noteimport nti
    //      JOIN semestre s ON nti.semestre = s.nomsemestre
    //     WHERE s.nomsemestre IS NULL
    //     ');
    // }

    public function insertNoteMatiereInNoteImport(){
        DB::insert('INSERT INTO notematiere(idmatiere,idetudiant,note,codmatiere)
        SELECT DISTINCT mat.idmatiere,etu.idetudiant,nti.note,nti.codematiere
        FROM noteimport nti
         JOIN matiere mat ON nti.codematiere = mat.codematiere
        JOIN etudiant etu ON nti.nom = etu.nom
        ');
    }

    // public function insertCaracteristiqueEtudiantInNoteImport(){
    //     DB::insert('INSERT INTO caracteristiqueetudiant(idetudiant,idsemestre)
    //     SELECT DISTINCT etu.idetudiant,s.idsemestre
    //     FROM noteimport nti
    //     JOIN etudiant etu ON nti.nom = etu.nom
    //     JOIN semestre s ON nti.semestre= s.nomsemestre
    //     ');
    // }


    public function insertEtudiantInNoteImport(){
        DB::insert('INSERT INTO etudiant(numetu,nom,prenom,datedenaissance,idpromotion,idgenre)
        SELECT DISTINCT nti.numetu,nti.nom,nti.prenom,nti.datedenaissance,pr.idpromotion,g.idgenre
        FROM noteimport nti
         JOIN promotion pr ON nti.promotion = pr.nompromotion
        JOIN genre g ON nti.genre = g.nomgenre
        ');
    }

}
