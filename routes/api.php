<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('users', [UserController::class, 'index']);
Route::group(['prefix' => 'user'], function () {
	Route::get('edit/{id}', [UserController::class, 'edit']);
	Route::post('update/{id}', [UserController::class, 'update']);
	Route::post('export', [UserController::class, 'export']);
});
