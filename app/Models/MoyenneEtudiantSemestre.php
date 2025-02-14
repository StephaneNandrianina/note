<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MoyenneEtudiantSemestre extends Model
{
    use HasFactory;
    protected $table = 'v_moyenneetudiantsemestre';
    protected $fillable = ['moyenneparsemestre'];
    public $timestamps = false;

    public static function getMoyenneParSemestreEtEtudiant(int $idSemestre, int $idEtudiant)
    {
        $result = DB::table('v_moyenneetudiantsemestre')
                    ->where('idsemestre', $idSemestre)
                    ->where('idetudiant', $idEtudiant)
                    ->value('moyenneparsemestre');

        return $result;
    }

}
