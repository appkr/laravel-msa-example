<?php

use App\Http\Controllers\ExampleController;
use App\Http\Middleware\TokenAuthenticate;
use Illuminate\Support\Facades\Route;

Route::prefix('examples')->middleware(TokenAuthenticate::class)->group(function () {
    Route::post('/', [ExampleController::class, 'createExample']);
    Route::get('/', [ExampleController::class, 'listExamples']);
});
