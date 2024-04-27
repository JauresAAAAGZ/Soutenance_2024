<?php

use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepotController;
use App\Http\Controllers\FichierController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use App\Models\Filiere;
use App\Models\Matiere;
use App\Models\Niveau;
use App\Models\Professeur;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/





Route::get('/', function () {
    return view('login-etu');
})->name('welcome');

Route::get('/dashboard-etudiant', function () {
    return view('dash-etu');
})->name('dashetu')->middleware('etudiant');

Route::get('/dashboard-enseignant', function () {
    return view('dash-ens');
})->name('dashens')->middleware('professeur');

Route::get('/dashboard-admin', function () {
    return view('dash-admin');
})->name('dashadmin')->middleware('admin');

Route::get('/dashboard-admin-utilisateurs', function () {
    return view('dash-admin-utilisateurs');
})->name('dashadmin1')->middleware('admin');

/*Route::get('/login-etudiant', function () {
    return view('login-etu');
})->name('loginetu');*/

Route::get('/register-etudiant', function () {
    return view('register-etu');
})->name('registeretu');

/*Route::get('/login-enseignant', function () {
    return view('login-ens');
})->name('login-ens');*/

Route::get('/register-enseignant', function () {
    return view('register-ens');
})->name('registerens');

Route::get('/recontact', function () {
    return view('recontact');
})->name('recontact');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::resource('etudiants', EtudiantController::class);
Route::resource('professeurs', ProfesseurController::class);
Route::resource('filieres', FiliereController::class);
Route::resource('admins', AdminController::class);
Route::resource('matieres', MatiereController::class);
Route::resource('niveaux', NiveauController::class);

Route::resource('depots', DepotController::class);

Route::resource('users', UserController::class);


// Route pour récupérer les informations de l'administrateur avec une requete AJAX
Route::get('/get-admin-info/{id}', [AdminController::class,'getAdminInfo'])->name('get.admin.info');

// Route pour récupérer les informations du professeur avec une requete AJAX
Route::get('/get-professeur-info/{id}', [ProfesseurController::class,'getProfesseurInfo'])->name('get.professeur.info');

// Route pour récupérer les informations de l'etudiant avec une requete AJAX
Route::get('/get-etudiant-info/{id}', [EtudiantController::class,'getInfo'])->name('get.etudiant.info');

//telecharger un fichier
Route::get('/download/{id}', [DepotController::class,'downloadFile'])->name('depot.download');

//ajouter un fichier a un depot après creation
Route::post('depots/{depot}/add-files', [DepotController::class,'addFiles'])->name('depots.add-files');

//fermer un depot
Route::post('/depots/{depot}/close', [DepotController::class,'closeDepot'])->name('depots.close');

//update the etat field of a depot
Route::post('/update-depot-etat/{depotId}', [DepotController::class,'updateDepotEtat'])->name('updateDepotEtat');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
