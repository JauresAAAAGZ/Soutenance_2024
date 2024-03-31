<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


use Illuminate\Foundation\Auth\User as Authenticatable;

class Etudiant extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guard='etudiant';
    
    protected $fillable = [
        'matricule',
        'nomEtudiant',
        'prenomEtudiant',
        'emailEtudiant',
        'date_naissance_etu',
        'niveau_etude',
    ];

  
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'pswdEtudiant',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'pswdEtudiant' => 'hashed',
    ];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function depots()
    {
        return $this->belongsToMany(Depot::class);
    }
    
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
