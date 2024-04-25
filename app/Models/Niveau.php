<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    use HasFactory;

    protected $fillable=['diplome_niveau','codeNiveau'];

    public function filieres()
    {
        return $this->belongsToMany(Filiere::class);
    }

    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }

    public function depots()
    {
        return $this->belongsToMany(Depot::class);
    }
}
