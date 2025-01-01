<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::get('/projects/generate-slug', [ProjectController::class, 'generateSlug'])->name('projects.generateSlug');

});
Route::middleware(['auth'])->group(function () {
    Route::resource('projects', ProjectController::class);
    Route::patch('projects/{project}/toggle-status', [ProjectController::class, 'toggleStatus'])->name('projects.toggle-status');

    //    Route::resource('users', UserController::class);
//    Route::resource('roles', RoleController::class);
//    Route::resource('permissions', PermissionController::class);
});
