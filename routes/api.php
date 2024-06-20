<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VideoController;
use App\Http\Controllers\Api\DeviceInfoController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/videos', [VideoController::class, 'upload']);
Route::get('/videos', [VideoController::class, 'index']);
Route::get('/device-videos/{deviceId}', [VideoController::class, 'getVideos']);
Route::post('/device-info', [DeviceInfoController::class, 'store']);
