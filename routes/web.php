<?php

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TodosController;

Route::get('/', function () {
    $todos = Todo::all();
    return view('todos', ['todos' => $todos]);
});

Route::get('/api/todos', [TodosController::class, 'findAll'])->name('todos');
Route::get('/api/todos/{id}', [TodosController::class, 'find'])->name('todos.find');
Route::post('/api/todos', [TodosController::class, 'create'])->name('todos.create');
Route::put('/api/todos/{id}', [TodosController::class, 'update'])->name('todos.update');
Route::delete('/api/todos/{id}', [TodosController::class, 'delete'])->name('todos.delete');
