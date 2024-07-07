<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ForkliftController;
use App\Http\Controllers\MalfunctionController;

Route::apiResource('forklifts', ForkliftController::class);
Route::get('search-forklifts', [ForkliftController::class, 'search']);

Route::apiResource('malfunctions', MalfunctionController::class);
Route::get('forklifts/{id}/malfunctions', [MalfunctionController::class, 'getMalfunctionsByForklift']);
