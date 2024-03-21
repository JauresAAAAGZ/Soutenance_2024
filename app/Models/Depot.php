<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depot extends Model
{
    use HasFactory;
    
    protected $fillable=['nomDepot', 'dateCreation','delai','dateFermeture'];





    public function etudiants()
    {
        return $this->belongsToMany(Etudiant::class);
    }

    public function fichiers()
    {
        return $this->hasMany(Fichier::class);
    }

    public function professeur()
    {
        return $this->belongsTo(Professeur::class);
    }
}
