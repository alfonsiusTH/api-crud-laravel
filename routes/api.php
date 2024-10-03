<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\MaterialCategoriesController;
use App\Http\Controllers\MaterialController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/material-categories', [MaterialCategoriesController::class, 'store']);
    Route::patch('/material-categories/{id}', [MaterialCategoriesController::class, 'update'])->middleware('materialCategories-user');
    Route::delete('/material-categories/{id}', [MaterialCategoriesController::class, 'destroy'])->middleware('materialCategories-user');

    Route::post('/material', [MaterialController::class, 'store']);
    Route::patch('material/{id}', [MaterialController::class, 'update'])->middleware('material-user');
    Route::delete('/material/{id}', [MaterialController::class, 'destroy'])->middleware('material-user');

    Route::get('/logout', [AuthenticationController::class, 'logout']);
});

Route::get('/material', [MaterialController::class, 'index']);
Route::get('/material-categories', [MaterialCategoriesController::class, 'index']);

Route::get('/material/{id}', [MaterialController::class, 'detail']);
Route::get('/material-categories/{id}', [MaterialCategoriesController::class, 'detail']);

Route::post('/login', [AuthenticationController::class, 'login']);
