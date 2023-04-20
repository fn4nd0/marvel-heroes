<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/heroes-list', [App\Http\Controllers\HeroController::class, 'list']);
Route::get('/hero-info/{marvel_id}', [App\Http\Controllers\HeroController::class, 'loadHeroInfo']);

