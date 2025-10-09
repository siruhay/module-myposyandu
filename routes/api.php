<?php

use Illuminate\Support\Facades\Route;
use Module\MyPosyandu\Http\Controllers\DashboardController;


Route::get('dashboard', [DashboardController::class, 'index']);