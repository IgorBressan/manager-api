<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthEmployeeController;
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
Route::group([
    'prefix' => 'auth',
    'middleware' => ['assign.guard:api','api'],
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});

Route::group([
    'prefix' => 'auth-employee',
    'middleware' => ['assign.guard:employee','api'],
], function ($router) {
    Route::post('/login', [AuthEmployeeController::class, 'login']);
    Route::post('/register', [AuthEmployeeController::class, 'register']);
    Route::post('/logout', [AuthEmployeeController::class, 'logout']);
    Route::post('/refresh', [AuthEmployeeController::class, 'refresh']);
    Route::get('/user-profile', [AuthEmployeeController::class, 'userProfile']);    
});