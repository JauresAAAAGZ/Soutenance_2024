<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Depot extends Model implements HasMedia
{
    use InteractsWithMedia;
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
    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public function niveaux()
    {
        return $this->belongsToMany(Niveau::class);
    }
    public function filieres()
    {
        return $this->belongsToMany(Filiere::class);
    }

}
