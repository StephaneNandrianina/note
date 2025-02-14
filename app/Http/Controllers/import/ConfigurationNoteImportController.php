<?php

namespace App\Http\Controllers\import;

use App\Http\Controllers\Controller;
use App\Models\ConfigurationNoteImport;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ConfigurationNoteImportController extends Controller
{
    public function toFileImportConfigurationNote(){
        return view('import.importation')->with('liste',[]);
    }

    public function importConfigurationNote(){
        try{
            $fichierExcel = request()->file('file');
            $rows = Excel::toArray([], $fichierExcel);
            $configImport = new ConfigurationNoteImport();
            $errors = [];
            $biens = [];

            DB::beginTransaction();

           for ($i = 1; $i < count($rows[0]); $i++) {
                $code = trim($rows[0][$i][0]);
                $config = trim($rows[0][$i][1]);
                $valeur = trim($rows[0][$i][2]);
                    

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
                
                $biens[] = ['code'=>$code,'config'=>$config,'valeur'=>$valeur];  
            }

            
            // if(count($errors)>0){
            //     throw new Exception("erreur de donnée");
            // }

            DB::table('configurationnoteimport')->insert($biens);
            $configImport->insertConfigurationNoteInConfigurationNoteImport();
            
             
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
