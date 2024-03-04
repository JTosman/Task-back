<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->group(function () {
    // Protected Routes

    // Task
    Route::post('task/create', [TaskController::class, 'create']);
    Route::post('task/update/{id}', [TaskController::class, 'update']);
    Route::get('task/delete/{id}', [TaskController::class, 'delete']);
    Route::get('task/complete/{id}', [TaskController::class, 'complete']);
    Route::get('tasks', [TaskController::class, 'list']);
    Route::get('task/{id}', [TaskController::class, 'get']);

    // Category
    Route::post('category/create', [CategoryController::class, 'create']);
    Route::post('category/update/{id}', [CategoryController::class, 'update']);
    Route::get('category/delete/{id}', [CategoryController::class, 'delete']);
    Route::get('categories', [CategoryController::class, 'list']);

    Route::post('logout', [UserController::class, 'logout']);
});

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
