<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Products routes
Route::any('add', ProductController::class.'@add');
Route::any('update', ProductController::class.'@update');
Route::any('delete', ProductController::class.'@delete');
Route::any('get', ProductController::class.'@get');

//User routes
Route::any('register', UserController::class.'@register');
Route::any('login', UserController::class.'@login');
