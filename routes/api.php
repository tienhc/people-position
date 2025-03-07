<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\SerialApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Test 1
Route::resource('accounts', AccountController::class);

//Test 2
Route::post('/showSerialpaso', [SerialApiController::class, 'showSerialPaso']);

//Test 3
Route::get('/student', [\App\Http\Controllers\StudentController::class, 'countStudents']);

//Test 4
Route::get('/people', [PeopleController::class, 'findLargestAgeDifference']);
