<?php

use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Admin;
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


/*--------------------------------------Etudiant Route------------------------------------*/


/*Route::prefix('etudiant')->group(function(){


    Route::get('/login', [EtudiantController::class, 'index'])->name('etudiant.login');

    Route::post('/login/treatement', [EtudiantController::class, 'login'])->name('etudiant.login.treatment');

    Route::get('/dashboard', [EtudiantController::class, 'dashboard'])->name('etudiant.dashboard')->middleware('etudiant');




});*/



/*--------------------------------------End Etudiant Route--------------------------------*/


/*--------------------------------------Professeur Route------------------------------------*/


/*Route::prefix('professeur')->group(function(){


    Route::get('/login', [ProfesseurController::class, 'index'])->name('professeur.login');

    Route::post('/login/treatement', [ProfesseurController::class, 'login'])->name('professeur.login.treatment');

    Route::get('/dashboard', [ProfesseurController::class, 'dashboard'])->name('professeur.dashboard')->middleware('professeur');




});*/



/*--------------------------------------End Professeur Route--------------------------------*/

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
