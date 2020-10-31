<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RewardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/project', [ProjectController::class, 'index']);
Route::get('/project/create', [ProjectController::class, 'create']);
Route::get('/project/delete', [ProjectController::class, 'deleteManager']);

Route::post('/project', [ProjectController::class, 'store']);
Route::put('/project', [ProjectController::class, 'update']);
Route::get('/project/findByStatus', [ProjectController::class, 'findByStatus']);
Route::get('/project/{id}', [ProjectController::class, 'show']);
Route::post('/project/{id}', [ProjectController::class, 'updateManager']);
Route::delete('/project/{id}', [ProjectController::class, 'delete']);

Route::get('/reward', [RewardController::class, 'index']);
Route::get('/reward/create', [RewardController::class, 'create']);

Route::post('/reward', [RewardController::class, 'store']);