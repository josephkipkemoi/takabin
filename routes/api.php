<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\CollecteeController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\CollectorController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('v1/register', [AuthController::class, 'store'])->name('store');
Route::post('v1/register/collector', [AuthController::class, 'store_collector'])->name('store_collector');
Route::post('v1/login', [AuthController::class, 'login'])->name('login');
Route::post('v1/logout', [AuthController::class, 'destroy']);

Route::controller(RoleController::class)->group(function() {
    Route::get('v1/roles', 'index');
});

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
})->middleware('auth:api');

Route::controller(AddressController::class)->group(function() {
    Route::post('v1/address', 'store');
    Route::get('v1/addresses/users/{user_id}', 'show');
});

Route::controller(ServiceController::class)->group(function() {
    Route::post('v1/services', 'store');
    Route::get('v1/services', 'index');
    Route::delete('v1/services/{service_id}', 'destroy');
});

Route::controller(BalanceController::class)->group(function() {
    Route::get('v1/users/{user_id}/balance', 'show');
    Route::patch('v1/users/{user_id}/balance', 'patch');
});

Route::controller(PaymentController::class)->group(function() {
    Route::post('v1/users/{user_id}/collections/{collection_id}/services/{service_id}', 'store');
    Route::get('v1/users/{user_id}/payments', 'show');
});

Route::controller(NotificationsController::class)->group(function() {
    Route::get('v1/users/{user_id}/notifications', 'show');
});