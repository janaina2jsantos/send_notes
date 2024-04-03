<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function() {
    return view('welcome');
});

// dashboard
Route::get('/dashboard', function() {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
// profile
Route::get('/profile', ['middleware'=>'auth', 'uses'=> \App\Http\Livewire\Profile::class])->name('profile');
// notes
Route::prefix('notes')->group(function () {
    Route::get('/', ['middleware'=>'auth', 'uses'=> \App\Http\Livewire\Notes::class])->name('notes.index');
    Route::get('/create', function() {
        return view('notes.create');
    })->middleware(['auth'])->name('notes.create');
    Route::get('/{id}/edit', function() {
        return view('notes.edit');
    })->middleware(['auth'])->name('notes.edit');
    Route::get('/{id}/delete', ['middleware'=>'auth', 'uses'=> [\App\Http\Livewire\Notes::class, 'delete']])->name('notes.delete');
});

require __DIR__.'/auth.php';
