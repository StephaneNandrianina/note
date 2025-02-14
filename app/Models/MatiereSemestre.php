<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatiereSemestre extends Model
{
    use HasFactory;
    protected $table = 'matieresemestre';
    protected $primaryKey = 'idmatieresemestre';
    protected $fillable = ['idmatiere','idsemestre','credit','identifiant'];
    public $timestamps = false;
}
