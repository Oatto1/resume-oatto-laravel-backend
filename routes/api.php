<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AboutMeController;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\SkillController;

Route::middleware('apikey')->group(function () {
    Route::get('/about-me', [AboutMeController::class, 'index']);

    Route::get('/portfolios', [PortfolioController::class, 'index']);
    Route::get('/portfolios/{id}', [PortfolioController::class, 'show']);

    Route::get('/skills', [SkillController::class, 'index']);
});