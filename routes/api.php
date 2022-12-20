<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CollecteeController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\CollectorController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('v1/register', [AuthController::class, 'store']);
Route::post('v1/login', [AuthController::class, 'login']);
Route::post('v1/logout', [AuthController::class, 'destroy']);

Route::controller(CollecteeController::class)->group(function() {
    Route::get('v1/users/{user_id}/collectee/collections/pending', 'pending');
});

Route::controller(CollectorController::class)->group(function() {
    Route::get('v1/collectors', 'index');
    Route::patch('v1/collections/{collection_id}/patch', 'patch');
    Route::patch('v1/collections/{collection_id}/picked', 'picked');
});

Route::controller(CollectionController::class)->group(function() {
    Route::post('v1/collections', 'store');
    Route::get('v1/collections/view', 'index');
});

Route::controller(AddressController::class)->group(function() {
    Route::post('v1/address', 'store');
});