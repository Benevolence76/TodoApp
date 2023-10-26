<?php

use App\Http\Controllers\MoodsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UsersController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Your routes for the TodoController
Route::get('todos/index', [TodoController::class, 'index'])->name('todos.index');
Route::get('todos/create', [TodoController::class, 'create'])->name('todos.create');
Route::post('todos/store', [TodoController::class, 'store'])->name('todos.store');
Route::get('todos/show/{id}', [TodoController::class, 'show'])->name('todos.show'); // Fix the route parameter
Route::get('todos/edit/{id}', [TodoController::class, 'edit'])->name('todos.edit'); // Fix the route parameter
Route::put('todos/update', [TodoController::class, 'update'])->name('todos.update');
Route::delete('todos/destroy/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy'); // Fix the route parameter

// Define the route to mark a todo as completed
Route::get('/todos/mark-as-completed/{id}', [TodoController::class, 'markAsCompleted'])->name('todos.markAsCompleted');

// Define the route to mark a todo as incompleted
Route::get('/todos/mark-as-incompleted/{id}', [TodoController::class, 'markAsIncompleted'])->name('todos.markAsIncompleted');




