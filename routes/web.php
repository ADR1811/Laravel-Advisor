<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EtablissementController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/etablissements', [EtablissementController::class, 'index'])->name('show.all.etablissements');
Route::get('/etablissements/{id}', [EtablissementController::class, 'show'])->where('id', '[0-9]+')->name('show.etablissement');


Route::get('/etablissements/create', [EtablissementController::class, 'create'])->middleware(['auth'])->name('create.etablissement');
Route::post('/etablissements/create', [EtablissementController::class, 'store'])->middleware(['auth'])->name('store.etablissement');

Route::get('/etablissements/{id}/edit', [EtablissementController::class, 'edit'])->middleware(['auth'])->name('edit.etablissement');
Route::post('/etablissements/{id}/edit', [EtablissementController::class, 'update'])->middleware(['auth'])->name('update.etablissement');

Route::get('/etablissements/{id}/delete', [EtablissementController::class, 'destroy'])->middleware(['auth'])->name('delete.etablissement');



require __DIR__ . '/auth.php';
