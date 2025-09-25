<?php

use App\Http\Controllers\CardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware("auth")->group(function() {
    Route::controller(CardController::class)->group(function() {
        Route::get("/getCard", "index")->name("index");
        Route::get("/getAllCards", "show")->name("show");
        Route::post("/createCard", "create")->name("create");
        Route::post("/updateCard", "update")->name("update");
        Route::post("/deleteCard", "delete")->name("delete");
    });
});
