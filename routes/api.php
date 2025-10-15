<?php

use Illuminate\Support\Facades\Route;
use Module\MyPosyandu\Http\Controllers\DashboardController;
use Module\MyPosyandu\Http\Controllers\MyPosyanduReportController;
use Module\MyPosyandu\Http\Controllers\MyPosyanduPremiseController;
use Module\MyPosyandu\Http\Controllers\MyPosyanduActivityController;
use Module\MyPosyandu\Http\Controllers\MyPosyanduComplaintController;
use Module\MyPosyandu\Http\Controllers\MyPosyanduRecipientController;
use Module\MyPosyandu\Http\Controllers\MyPosyanduBeneficiaryController;

Route::get('dashboard', [DashboardController::class, 'index']);
Route::get('fetch-combos', [DashboardController::class, 'combos']);
Route::get('fetch-data', [DashboardController::class, 'record']);
Route::post('upload-document', [DashboardController::class, 'upload']);
Route::get('upload-document', [DashboardController::class, 'download']);
Route::delete('upload-document', [DashboardController::class, 'destroy']);

Route::resource('complaint', MyPosyanduComplaintController::class)->parameters(['complaint' => 'myPosyanduComplaint']);

Route::post('activity/{myPosyanduActivity}/posted', [MyPosyanduActivityController::class, 'posted']);
Route::resource('activity', MyPosyanduActivityController::class)->parameters(['activity' => 'myPosyanduActivity']);

Route::resource('activity.premise', MyPosyanduPremiseController::class)->parameters([
    'activity' => 'myPosyanduActivity',
    'premise' => 'myPosyanduPremise'
]);

Route::resource('activity.recipient', MyPosyanduRecipientController::class)->parameters([
    'activity' => 'myPosyanduActivity',
    'recipient' => 'myPosyanduRecipient'
]);

Route::resource('beneficiary', MyPosyanduBeneficiaryController::class)->parameters(['beneficiary' => 'myPosyanduBeneficiary']);

Route::resource('report', MyPosyanduReportController::class)->parameters(['report' => 'myPosyanduReport']);
