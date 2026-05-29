<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test', function () {
    return response()->json([
        'message' => 'OK'
    ]);
});
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('categories', CategoryController::class)
        ->except(['destroy']);

    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])
        ->middleware('role:admin');

    Route::apiResource('items', ItemController::class)
        ->except(['destroy']);

    Route::delete('items/{item}', [ItemController::class, 'destroy'])
        ->middleware('role:admin');
});