<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aqui é onde você pode registrar as rotas da web para sua aplicação.
| Essas rotas são carregadas pelo RouteServiceProvider dentro de um grupo
| que contém o middleware "web". Agora, crie algo incrível!
|
*/

// Rota para a página inicial
Route::get('/', function () {
    return view('home');
});

// Rotas de autenticação
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Rotas de autenticação padrão do Laravel
Auth::routes(['verify' => true]);

// Rota para a página home após o login
Route::get('/home', [HomeController::class, 'index'])->name('home');