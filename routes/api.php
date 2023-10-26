<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\TodosApiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public Routes - Unsecured
Route::post('register', [AuthApiController::class, 'register']);
Route::post('login', [AuthApiController::class, 'login']);

// Secured Private Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('todos', [TodosApiController::class, 'index']);
    Route::post('todo', [TodosApiController::class, 'store']);
    Route::delete('todo/{id}', [TodosApiController::class, 'destroy']);
});
