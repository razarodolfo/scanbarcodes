<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Scanbarcodes;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route Hooks - Do not delete//
	Route::view('scanbarcodes', 'livewire.scanbarcodes.index')->middleware('auth');
	Route::view('asistencias', 'livewire.asistencias.index')->middleware('auth');
	Route::view('empleados', 'livewire.empleados.index')->middleware('auth');

	//Route::get('scanbarcodes', Scanbarcodes::class)->name('scanbarcodes');
