<?php

use Illuminate\Support\Facades\Route;
use Module\MyPosyandu\Http\Controllers\DashboardController;
use Module\MyPosyandu\Http\Controllers\MyPosyanduActivityController;

Route::get('dashboard', [DashboardController::class, 'index']);
Route::post('upload-document', [DashboardController::class, 'upload']);
Route::get('upload-document', [DashboardController::class, 'download']);
Route::delete('upload-document', [DashboardController::class, 'destroy']);

Route::resource('activity', MyPosyanduActivityController::class)->parameters(['activity' => 'myPosyanduActivity']);
