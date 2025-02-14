<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annee extends Model
{
    use HasFactory;
     // Spécifiez la table associée si ce n'est pas le nom par défaut
     protected $table = 'annee';

     // Indiquez les colonnes qui peuvent être massivement assignées
     protected $fillable = ['nomannee'];
 
     public function semestres()
     {
         return $this->hasMany(Semestre::class, 'idannee');
     }
 
}
