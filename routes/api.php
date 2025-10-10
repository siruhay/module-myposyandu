<?php

use Illuminate\Support\Facades\Route;
use Module\MyPosyandu\Http\Controllers\DashboardController;
use Module\MyPosyandu\Http\Controllers\MyPosyanduActivityController;

Route::get('dashboard', [DashboardController::class, 'index']);

Route::resource('activity', MyPosyanduActivityController::class)->parameters(['activity' => 'myPosyanduActivity']);
