<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepotController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Les comptes sont créés par l'administrateur : il n'y a pas d'inscription
| publique. Les droits liés à un dépôt précis (le sien, celui de sa filière)
| sont vérifiés dans DepotController.
|
*/

Route::get('/', function () {
    return view('login-etu');
})->name('welcome');

// Tableaux de bord
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

Route::get('/dashboard-service-examen', function () {
    return view('dashExamen');
})->name('dashExamen')->middleware('serviceexamen');

Route::middleware('auth')->group(function () {

    // Redirige vers le tableau de bord correspondant au rôle
    Route::get('/dashboard', function () {
        $accueil = [1 => 'dashetu', 2 => 'dashens', 3 => 'dashadmin', 4 => 'dashExamen'];

        return redirect()->route($accueil[Auth::user()->role_id] ?? 'welcome');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Administration
    Route::middleware('role:admin')->group(function () {
        Route::get('/get-admin-info/{id}', [AdminController::class, 'getAdminInfo'])->name('get.admin.info');
        Route::get('/get-professeur-info/{id}', [ProfesseurController::class, 'getProfesseurInfo'])->name('get.professeur.info');
        Route::get('/get-etudiant-info/{id}', [EtudiantController::class, 'getInfo'])->name('get.etudiant.info');

        Route::resource('users', UserController::class);
        Route::resource('etudiants', EtudiantController::class);
        Route::resource('professeurs', ProfesseurController::class);
        Route::resource('admins', AdminController::class);
        Route::resource('filieres', FiliereController::class);
        Route::resource('niveaux', NiveauController::class);
        Route::resource('matieres', MatiereController::class);
    });

    // Gestion des dépôts par le professeur (déclarée avant depots/{depot})
    Route::middleware('role:professeur')->group(function () {
        Route::resource('depots', DepotController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
        Route::get('/depots/{depot}/students', [DepotController::class, 'showDepotStudents'])->name('depots.students');
        Route::post('/depots/{depot}/submit-notes', [DepotController::class, 'submitNotes'])->name('depots.submitNotes');
    });

    // Rendu de l'étudiant
    Route::post('/depots/{depot}/add-files', [DepotController::class, 'addFiles'])
        ->middleware('role:etudiant')
        ->name('depots.add-files');

    // Consultation, accessible à tous les rôles connectés
    Route::resource('depots', DepotController::class)->only(['index', 'show']);
    Route::get('/depots/{depot}/download-professor-files', [DepotController::class, 'downloadProfessorFiles'])->name('depots.downloadProfessorFiles');
    Route::get('/download/{id}', [DepotController::class, 'downloadFile'])->name('depot.download');
    Route::delete('/depot/{id}/delete-file', [DepotController::class, 'deleteFile'])->name('depot.delete-file');
    Route::post('/update-depot-etat/{depotId}', [DepotController::class, 'updateDepotEtat'])->name('updateDepotEtat');
});

require __DIR__.'/auth.php';
