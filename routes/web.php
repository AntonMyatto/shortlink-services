<?php

use App\Http\Controllers\GenerateLinkController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['middleware' => 'role:root,mngr,cnt,sc']);
    Route::resource('generate-links', GenerateLinkController::class)->middleware(['middleware' => 'role:root,sc']);
    Route::get('{generated}', [App\Http\Controllers\GenerateLinkController::class, 'showGeneratedLink'])->name('generate-link')->middleware(['middleware' => 'role:root,sc']);
    Route::resource('users', UserController::class)->middleware(['middleware' => 'role:root']);
    Route::resource('roles', RoleController::class)->middleware(['middleware' => 'role:root']);
    Route::resource('permissions', PermissionController::class)->middleware(['middleware' => 'role:root']);
    Route::get('error-rules', [App\Http\Controllers\RoleController::class, 'norole'])->name('norole');
});

Auth::routes();
