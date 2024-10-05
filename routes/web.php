<?php

use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/teams', [TeamController::class, 'getAll']);
Route::get('/teams/{id}', [TeamController::class, 'getById']);
Route::get('/teams/WithoutPlayers', [TeamController::class, 'getWithoutPlayers']);
Route::post('/teams/createTeam', [TeamController::class, 'createTeam']);