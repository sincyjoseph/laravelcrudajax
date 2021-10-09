<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\API\PassportAuthController;
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


Route::post('/register', [PassportAuthController::class, 'register']);
Route::post('/login', [PassportAuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::get('get-userdata', [PassportAuthController::class, 'userInfo']);
    Route::get('/get-user',[UserController::class,'getUser'])->name('getUser');
    Route::post('/add-user',[UserController::class,'addUser'])->name('addUser');
    Route::post('/delete-user',[UserController::class,'deleteUser'])->name('deleteUser');
});




