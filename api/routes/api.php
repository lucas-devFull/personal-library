<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LibraryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/library/{id}', 'App\Http\Controllers\API\LibraryController@updateBook');
Route::apiResource('/library', LibraryController::class);
