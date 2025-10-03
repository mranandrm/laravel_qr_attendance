<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QRController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/generate-qr-code/{eventId}', [QRController::class, 'generateQrCode'])->name('generateQrCode');
Route::get('/generate-report', [ReportController::class, 'generateReport']);
