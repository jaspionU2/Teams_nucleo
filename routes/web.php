<?php

use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/teams', [TeamController::class, 'getAll']);
Route::post('/teams/create', [TeamController::class, 'createTeam']);
Route::get('/teams/WithoutPlayers', [TeamController::class, 'getWithoutPlayers']);
Route::get('/teams/{id}', [TeamController::class, 'getById']);
Route::delete('/teams/{id}', [TeamController::class, 'deleteTeam']);