<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ConfigurationNoteImport extends Model
{
    use HasFactory;
    protected $table = 'bienImport';
    protected $primaryKey = 'idetapeimport';
    protected $fillable = ['reference','nom','description','type','region','loyer','proprietaire'];
    public $timestamps = false;

    public function insertConfigurationNoteInConfigurationNoteImport(){
        DB::insert('INSERT INTO configurationnote(code,config,valeur)
            SELECT DISTINCT cfg.code , cfg.config, cfg.valeur
            FROM configurationnoteimport cfg
            LEFT JOIN configurationnote c ON cfg.code = c.code
            WHERE c.code is null
        ');
    }
}
