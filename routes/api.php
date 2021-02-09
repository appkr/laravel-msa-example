<?php

use App\Http\Controllers\ExampleController;
use App\Http\Controllers\HelloController;
use App\Http\Middleware\TokenAuthenticate;
use Illuminate\Support\Facades\Route;

Route::prefix('examples')->middleware(TokenAuthenticate::class)->group(function () {
    Route::post('/', [ExampleController::class, 'createExample']);
    Route::get('/', [ExampleController::class, 'listExamples']);
});

Route::prefix('hello')->middleware(TokenAuthenticate::class)->group(function () {
    Route::get('/', [HelloController::class, 'hello']);
});
