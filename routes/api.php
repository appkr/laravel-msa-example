<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\SingerController;
use App\Http\Controllers\SongController;
use App\Http\Middleware\TokenAuthenticate;
use Illuminate\Support\Facades\Route;

Route::prefix('examples')->middleware(TokenAuthenticate::class)->group(function () {
    Route::post('/', [ExampleController::class, 'createExample']);
    Route::get('/', [ExampleController::class, 'listExamples']);
});

Route::prefix('hello')->middleware(TokenAuthenticate::class)->group(function () {
    Route::get('/', [HelloController::class, 'hello']);
});

Route::prefix('albums')->middleware(TokenAuthenticate::class)->group(function () {
    Route::post('/', [AlbumController::class, 'createAlbum']);
    Route::get('/', [AlbumController::class, 'listAlbums']);
    Route::post('/{albumId}/songs/{songId}', [AlbumController::class, 'associateSong']);
    Route::post('/{albumId}/singer/{singerId}', [AlbumController::class, 'associateSinger']);
});

Route::prefix('singers')->middleware(TokenAuthenticate::class)->group(function () {
    Route::post('/', [SingerController::class, 'createSinger']);
});

Route::prefix('songs')->middleware(TokenAuthenticate::class)->group(function () {
    Route::post('/', [SongController::class, 'createSong']);
    Route::get('/{songId}', [SongController::class, 'getSong']);

});
