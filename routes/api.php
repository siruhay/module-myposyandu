<?php

use Illuminate\Support\Facades\Route;
use Module\MyPosyandu\Http\Controllers\DashboardController;
use Module\MyPosyandu\Http\Controllers\MyPosyanduReportController;
use Module\MyPosyandu\Http\Controllers\MyPosyanduActivityController;
use Module\MyPosyandu\Http\Controllers\MyPosyanduComplaintController;

Route::get('dashboard', [DashboardController::class, 'index']);
Route::get('fetch-combos', [DashboardController::class, 'combos']);
Route::post('upload-document', [DashboardController::class, 'upload']);
Route::get('upload-document', [DashboardController::class, 'download']);
Route::delete('upload-document', [DashboardController::class, 'destroy']);

Route::resource('complaint', MyPosyanduComplaintController::class)->parameters(['activity' => 'myPosyanduComplaint']);

Route::resource('activity', MyPosyanduActivityController::class)->parameters(['activity' => 'myPosyanduActivity']);

Route::resource('report', MyPosyanduReportController::class)->parameters(['report' => 'myPosyanduReport']);
