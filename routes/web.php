<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EtablissementController;
use App\Http\Controllers\CommentaireController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


// Route pour voir un ou des établissements
Route::get('/', [EtablissementController::class, 'index'])->name('show.all.etablissements');
Route::get('/place/{id}', [EtablissementController::class, 'show'])->where('id', '[0-9]+')->name('show.etablissement');
Route::get('/mes-places', [EtablissementController::class, 'showForUser'])->name('show.my-etablissement');


// route pour créer un établissement et le mettre en base de données
Route::get('/place/create', [EtablissementController::class, 'create'])->middleware(['auth'])->name('create.etablissement');
Route::post('/place/create', [EtablissementController::class, 'store'])->middleware(['auth'])->name('store.etablissement');

// route pour modifier un établissement et le mettre en base de données
Route::get('/place/{id}/edit', [EtablissementController::class, 'edit'])->middleware(['auth'])->name('edit.etablissement');
Route::post('/place/{id}/edit', [EtablissementController::class, 'update'])->middleware(['auth'])->name('update.etablissement');

// route pour supprimer un établissement
Route::get('/place/{id}/delete', [EtablissementController::class, 'destroy'])->middleware(['auth'])->name('delete.etablissement');

// route pour ajouter modifier ou supprimer un commentaire
Route::post('/comments/{id}/store', [CommentaireController::class, 'store'])->middleware(['auth'])->name('store.comment');
Route::get('/comments/{id}/delete', [CommentaireController::class, 'destroy'])->middleware(['auth'])->name('delete.comment');
Route::post('/comments/{id}/update', [CommentaireController::class, 'update'])->middleware(['auth'])->name('update.comment');





require __DIR__ . '/auth.php';
