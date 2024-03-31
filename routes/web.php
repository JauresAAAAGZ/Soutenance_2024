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
use App\Http\Middleware\Admin;
use App\Models\Filiere;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
