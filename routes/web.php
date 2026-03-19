<?php


use App\Http\Controllers\EtudiantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\SetLocaleController;


Route::get('/', [EtudiantController::class, 'index'])->name('etudiant.index');
Route::get('/etudiants', [EtudiantController::class, 'index'])->name('etudiant.index');
Route::get('/create/etudiant', [EtudiantController::class, 'create'])->name('etudiant.create');
Route::post('/create/etudiant', [EtudiantController::class, 'store'])->name('etudiant.store');
Route::get('/etudiant/{etudiant}', [EtudiantController::class, 'show'])->name('etudiant.show');
Route::get('/edit/etudiant/{etudiant}', [EtudiantController::class, 'edit'])->name('etudiant.edit');
Route::put('/edit/etudiant/{etudiant}', [EtudiantController::class, 'update'])->name('etudiant.update');
Route::delete('/etudiant/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiant.destroy');


Route::get('/login', [AuthController::class, 'create'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');
Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');


Route::get('/lang/{locale}', [SetLocaleController::class, 'index'])->name('lang');


Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
Route::get('/user/forum', [ForumController::class, 'user'])->name('forum.user');
// Route::get('/create/forum', [ForumController::class, 'create'])->name('forum.create');
Route::post('/user/forum', [ForumController::class, 'store'])->name('forum.store');
Route::get('/forum/{forum}', [ForumController::class, 'show'])->name('forum.show');
Route::get('/edit/forum/{forum}', [ForumController::class, 'edit'])->name('forum.edit');
Route::put('/edit/forum/{forum}', [ForumController::class, 'update'])->name('forum.update');
Route::delete('/user/forum/{forum}', [ForumController::class, 'destroy'])->name('forum.destroy');
