<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ForkliftController;
use App\Http\Controllers\MalfunctionController;

Route::apiResource('forklifts', ForkliftController::class);
Route::apiResource('malfunctions', MalfunctionController::class);
