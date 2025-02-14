<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;
    protected $table = 'matiere';
    protected $primaryKey = 'idmatiere';
    protected $fillable = ['nommatiere','codematiere','identification','credit'];
    public $timestamps = false;
}
