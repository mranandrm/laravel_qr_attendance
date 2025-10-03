<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\AttendanceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/upload-profile-pic', [AuthController::class, 'upload']);
     Route::post('/mark-attendance/{eventId}', [AttendanceController::class, 'markAttendance']);
    Route::get('/attendance/history', [AttendanceController::class, 'getAttendanceHistory']);
});

Route::post('/user/isMobileNumberRegistered', [UserController::class, 'isMobileNumberRegistered']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/mark-attendance/{eventId}', [QRController::class, 'markAttendance']);
Route::get('/attendances', [AttendanceController::class, 'index']);
Route::post('/attendance/generate-qrcode', [AttendanceController::class, 'generateQrCode']);
