<?php

use Illuminate\Support\Facades\Route;
use TechEd\SimplOtp\Http\Controllers\OtpController;

Route::prefix('simplotp')->group(function () {
    Route::get('/generate', [OtpController::class, 'showGenerateForm'])->name('simplotp.generate.form');
    Route::post('/generate', [OtpController::class, 'generate'])->name('simplotp.generate');
    Route::get('/verify', [OtpController::class, 'showVerifyForm'])->name('simplotp.verify.form');
    Route::post('/verify', [OtpController::class, 'verify'])->name('simplotp.verify');
});