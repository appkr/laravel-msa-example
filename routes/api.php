<?php

use App\Http\Controllers\ExampleController;
use Illuminate\Support\Facades\Route;

Route::prefix('examples')->group(function () {
    Route::post('/', [ExampleController::class, 'createExample']);
    Route::get('/', [ExampleController::class, 'listExamples']);
});
