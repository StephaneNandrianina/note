<?php

namespace App\Http\Controllers\import;

use App\Http\Controllers\Controller;
use App\Models\NoteImport;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class NoteImportController extends Controller
{
    public function toFileImportNote(){
        return view('import.importationNote')->with('liste',[]);
    }

    public function importNote(){
        try{
            $fichierExcel = request()->file('file');
            $rows = Excel::toArray([], $fichierExcel);
            $notes = new NoteImport();
            $errors = [];
            $biens = [];

            DB::beginTransaction();

           for ($i = 1; $i < count($rows[0]); $i++) {
                $numetu = trim($rows[0][$i][0]);
                $nom = trim($rows[0][$i][1]);
                $prenom = trim($rows[0][$i][2]);
                $genre = trim($rows[0][$i][3]);
                $datedenaissance = trim($rows[0][$i][4]);
                $promotion = trim($rows[0][$i][5]);
                $codematiere = trim($rows[0][$i][6]);
                $semestre = trim($rows[0][$i][7]);
                $note = trim($rows[0][$i][8]);    

                // if(empty($etape)){
                //     $errors[] = "l etape est null a la ligne ".$i;
                // }
                // if(empty($longueur)){
                //     $errors[] = "la longueur est null a la ligne ".$i; 
                // }
                // if(empty($nombreCoureur)){
                //     $errors[] = "le nombre de coureur est null a la ligne ".$i; 
                // }

                // if(empty($rang)){
                //     $errors[] = "le rang  est null a la ligne ".$i; 
                // }

                // if(empty($dateDepart)){
                //     $errors[] = "la date de depart  est null a la ligne ".$i; 
                // }

                // if(empty($heureDepart)){
                //     $errors[] = "l heure de depart  est null a la ligne ".$i; 
                // }
                $note = str_replace(",",".",$note);
                $biens[] = ['numetu'=>$numetu,'nom'=>$nom,'prenom'=>$prenom,'genre'=>$genre,'datedenaissance'=>$datedenaissance,'promotion'=>$promotion,'codematiere'=>$codematiere,'semestre'=>$semestre,'note'=>$note];  
            }

            
            // if(count($errors)>0){
            //     throw new Exception("erreur de donnée");
            // }

            DB::table('noteimport')->insert($biens);
             $notes->insertGenreInNoteImport();
             $notes->insertPromotionInNoteImport();
             $notes->insertEtudiantInNoteImport();
             $notes->insertNoteMatiereInNoteImport();
            //  $notes->insertCaracteristiqueEtudiantInNoteImport();
             
            DB::commit();
            // DB::table('etapeimport')->truncate();
            return  response()->json(['liste' => $errors]);
        }catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
           
            // return response()->json(['liste' => $errors]);
        }
    }
}
