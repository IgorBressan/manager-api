<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthManagerController;
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
    'prefix' => 'user',
    'middleware' => ['assign.guard:api','api'],
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});

Route::group([
    'prefix' => 'manager',
    'middleware' => ['assign.guard:manager','api'],
], function ($router) {
    Route::post('/login', [AuthManagerController::class, 'login']);
    Route::post('/register', [AuthManagerController::class, 'register']);
    Route::post('/logout', [AuthManagerController::class, 'logout']);
    Route::post('/refresh', [AuthManagerController::class, 'refresh']);
    Route::get('/user-profile', [AuthManagerController::class, 'userProfile']);    
    Route::get('/logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
});