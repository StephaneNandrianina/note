<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaracteristiqueEtudiant extends Model
{
    use HasFactory;
    protected $table = 'caracteristiqueetudiant';
    protected $primaryKey = 'ididcaracteristiqueetudiant';
    protected $fillable = ['idetudiant','idsemestre'];
    public $timestamps = false;
}
