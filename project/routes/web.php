<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Auth;
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

    Route::name('projects_')->prefix('projects')->group(function (){
        Route::get('/', [ProjectController::class, 'index'])->name('index');
        Route::get('/create', [ProjectController::class, 'create'])->name('create');
        Route::post('/create', [ProjectController::class, 'store'])->name('store');
        Route::get('/{project}', [ProjectController::class, 'show'])->name('show');
        Route::get('/{project}/edit', [ProjectController::class, 'edit'])->name('edit');
        Route::put('/{project}/edit', [ProjectController::class, 'update'])->name('update');
        Route::get('/{project}/delete', [ProjectController::class, 'delete'])->name('delete');
        Route::delete('/{project}/delete', [ProjectController::class, 'destroy'])->name('destroy');
        Route::post('/{project}/run', [ProjectController::class, 'run'])->name('run');

        // file controller methods:
        Route::name('files_')->prefix('{project}/files')->group(function (){
            Route::get('/{file}/delete', [FileController::class, 'delete'])->name('delete');
            Route::delete('/{file}/delete', [FileController::class, 'destroy'])->name('destroy');
            Route::get('/upload', [FileController::class, 'upload'])->name('upload');
            Route::post('/upload', [FileController::class, 'uploadFiles'])->name('upload');
            Route::put('/{file}/save', [FileController::class, 'save'])->name('save');
            Route::get('/{file}/rename', [FileController::class, 'rename'])->name('rename');
            Route::put('/{file}/rename', [FileController::class, 'updateName'])->name('updateName');
            Route::get('/{file}/saveAs', [FileController::class, 'saveAs'])->name('saveAs');
            Route::put('/{file}/storeAs', [FileController::class, 'storeAs'])->name('storeAs');
        });
    });
});

Route::resource('projects.files', App\Http\Controllers\FileController::class)->middleware('auth');

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

