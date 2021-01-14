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

Route::middleware('auth')->group(function() {
    Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index'])->name('projects');
    Route::get('/projects/create', [App\Http\Controllers\ProjectController::class, 'create'])->name('projects_create');
    Route::post('/projects/create', [App\Http\Controllers\ProjectController::class, 'store'])->name('projects_store');
    Route::get('/projects/{project}', [App\Http\Controllers\ProjectController::class, 'show'])->name('projects_show');
    Route::get('/projects/{project}/edit', [App\Http\Controllers\ProjectController::class, 'edit'])->name('projects_edit');
    Route::put('/projects/{project}/edit', [App\Http\Controllers\ProjectController::class, 'update'])->name('projects_update');
    Route::get('/projects/{project}/delete', [App\Http\Controllers\ProjectController::class, 'delete'])->name('projects_delete');
    Route::delete('/projects/{project}/delete', [App\Http\Controllers\ProjectController::class, 'destroy'])->name('projects_destroy');
});

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

