<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware("auth")->group(function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::controller(CardController::class)->group(function() {
        Route::get("/getCard", "index")->name("index");
        Route::get("/getAllCards", "show")->name("show");
        Route::post("/createCard", "create")->name("create");
        Route::post("/updateCard", "update")->name("update");
        Route::post("/deleteCard", "delete")->name("delete");
    });
});
