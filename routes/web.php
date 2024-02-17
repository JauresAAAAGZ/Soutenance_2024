<?php

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
    return view('welcome');
})->name('welcome');

Route::get('/dashboard-etudiant', function () {
    return view('dash-etu');
})->name('dashetu');

Route::get('/dashboard-enseignant', function () {
    return view('dash-ens');
})->name('dashens');


Route::get('/login-etudiant', function () {
    return view('login-etu');
})->name('loginetu');

Route::get('/register-etudiant', function () {
    return view('register-etu');
})->name('registeretu');

Route::get('/login-enseignant', function () {
    return view('login-ens');
})->name('loginens');

Route::get('/register-enseignant', function () {
    return view('register-ens');
})->name('registerens');

Route::get('/recontact', function () {
    return view('recontact');
})->name('recontact');


