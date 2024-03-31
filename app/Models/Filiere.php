<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    use HasFactory;
    protected $fillable=['nomFiliere', 'niveauEtude'];



    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }

    public function niveaux()
    {
        return $this->belongsToMany(Niveau::class);
    }
    
}
