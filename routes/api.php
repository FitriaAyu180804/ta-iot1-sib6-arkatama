<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MqSensorController;
use App\Http\Controllers\Api\Dht11SensorController;
use App\Http\Controllers\Api\RainSensorController;
use App\Http\Controllers\Api\LedController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// route group name api
Route::group(['as' => 'api.'], function () {
    // resource route
    Route::resource('users', UserController::class)
        ->except(['create', 'edit']);

    Route::get('sensors/mq', [MqSensorController::class, 'index'])
        ->name('sensors.mq.index');

    Route::post('sensors/mq', [MqSensorController::class, 'store'])
        ->name('sensors.mq.store');

    Route::get('sensors/dht11', [Dht11SensorController::class, 'index'])
        ->name('sensors.dht11.index');
    Route::post('sensors/dht11', [Dht11SensorController::class, 'store']);

    Route::resource('sensors/rain', RainSensorController::class)
        ->names('sensors.rain');

        Route::prefix('v1/leds')->name('leds.')->group(function () {
            Route::get('/', [LedController::class, 'index'])->name('index');
            Route::get('/{id}', [LedController::class, 'show'])->name('show');
            Route::post('/', [LedController::class, 'store'])->name('store');
            Route::put('/{id}', [LedController::class, 'update'])->name('update');
            Route::delete('/{id}', [LedController::class, 'destroy'])->name('destroy');
        });



});
