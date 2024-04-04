<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;


    protected $fillable=['intitule', 'codeMatiere', 'duree'];


    public function professeurs()
    {
        return $this->belongsToMany(Professeur::class);
    }
}
