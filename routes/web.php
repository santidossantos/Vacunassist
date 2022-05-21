<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\RegisterController;
use App\Mail\TurnoMailable;
use App\Models\Turno;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HistoriaclinicaController;
use App\Models\HistoriaClinica;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\UserController;

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


/*
|--------------------------------------------------------------------------
| View Routes
|--------------------------------------------------------------------------
*/

Route::view('/', 'index')->middleware('guest');
Route::view('login', 'login')->name('login')->middleware('guest');
Route::view('dashboard', 'dashboard')->middleware('auth');
Route::view('home', 'home')->name('home')->middleware('auth');
Route::view('register', 'register')->name('register')->middleware('guest');
Route::view('ver-turnos', 'ver-turnos')->name('ver-turnos')->middleware('auth');
Route::view('solicitar-turno', 'solicitar-turno')->name('solicitar-turno')->middleware('auth');
Route::view('historiaclinica', 'historiaclinica')->name('historiaclinica')->middleware('auth');
Route::view('formhistoriaclinica', 'formhistoriaclinica')->name('formhistoriaclinica')->middleware('auth');
Route::view('generar-pdf', 'generar-pdf')->name('generar-pdf')->middleware('auth');
Route::view('miperfil', 'miperfil')->name('miperfil')->middleware('auth');
Route::view('turno-automatico-registro', 'turno-automatico-registro')->name('turno-automatico-registro')->middleware('auth');


/*
|--------------------------------------------------------------------------
| Get Routes
|--------------------------------------------------------------------------
*/

Route::get('contactanos', [MailController::class, 'send']);
Route::get('turnos/{id}', [TurnoController::class, 'edit'])->name('turnos.edit');
Route::get('emitir-certificado', [HistoriaclinicaController::class, 'generarPDF'])->name('emitir-certificado');



/*
|--------------------------------------------------------------------------
| Post Routes
|--------------------------------------------------------------------------
*/

Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout']);
Route::post('register', [RegisterController::class, 'store']);
Route::post('solicitar-turno', [TurnoController::class, 'store']);
Route::post('formhistoriaclinica', [HistoriaclinicaController::class, 'store']);
Route::post('turno-automatico-registro', [TurnoController::class, 'turnoAutomatico']);
Route::post('miperfil', [UserController::class, 'edit']);
