<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Public
Route::post('/auth/login', [AuthController::class,  "login"]);

//Private Routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    //Auth
    Route::post('/auth/register', [AuthController::class,  "register"]);
    Route::post('/auth/logout', [AuthController::class,  "login"]);
    Route::get('/auth/about-me', [AuthController::class,  "getUserInfo"]);

    //Products
    Route::resource("/products", ProductController::class);
});
