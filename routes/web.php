<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\PersonPositionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/furthest-people', [PersonPositionController::class, 'getFurthestPeople']);

