<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function () {

    Route::get('customers/{id}' , [CustomersController::class, 'show']);
    Route::patch('customers/{id}' , [CustomersController::class, 'update']);
    Route::delete('customers/{id}' , [CustomersController::class, 'delete']);
    Route::get('customers' , [CustomersController::class, 'index']);
    Route::post('customers/export' , [CustomersController::class, 'export']);
    Route::post('customers' , [CustomersController::class, 'create']);

    Route::get('customers/{customerId}/notes/{id}' , [NotesController::class, 'show']);
    Route::patch('customers/{customerId}/notes/{id}' , [NotesController::class, 'update']);
    Route::delete('customers/{customerId}/notes/{id}' , [NotesController::class, 'delete']);
    Route::get('customers/{customerId}/notes' , [NotesController::class, 'index']);
    Route::post('customers/{customerId}/notes' , [NotesController::class, 'create']);

    //Route::get('customers/{customerId}/projects/{id}' , [ProjectController::class, 'show']);
    //Route::patch('customers/{customerId}/projects/{id}' , [ProjectController::class, 'update']);
    //Route::delete('customers/{customerId}/projects/{id}' , [ProjectController::class, 'delete']);
    //Route::get('customers/{customerId}/projects' , [ProjectController::class, 'index']);
    Route::post('customers/{customerId}/projects' , [ProjectController::class, 'createProject']);
});

Route::post('users' , [UserController::class, 'create']);
