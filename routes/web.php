<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\InscricaoController;
use App\Http\Controllers\HomeController; // Se estiver usando o HomeController padrão

// Rotas de Autenticação (geradas pelo laravel/ui)
Auth::routes();

// Rota Principal (Home)
Route::get('/', [HomeController::class, 'index'])->name('home'); // Ou aponte para CursoController@index

// Rotas para Cursos (index e show são públicos)
Route::resource('cursos', CursoController::class);

// Rotas para Inscrições (todas protegidas por autenticação, conforme definido no controller)
Route::resource('inscricoes', InscricaoController::class)->middleware('auth'); // Dupla garantia

// Exemplo de rota pública para listar cursos, caso não queira usar /cursos como home
Route::get('/catalogo-cursos', [CursoController::class, 'index'])->name('cursos.public.index');
