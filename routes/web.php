<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Links;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

Route::get("/register",         [function() {
    return view("auth/register");
}]);
Route::get("/login",            [function() {
    return view("auth/login");
}]);

Route::post("/logout",          [LogoutController::class,  "logout"]);
Route::post("/login/user",      [LoginController::class,    "login"]);
Route::post("/register/user",   [RegisterController::class, "store"]);
Route::get("/dashboard",        [Links::class,              "dashboard"])->middleware("auth");
Route::get('/',                 [Links::class,              "index"]);
Route::post("/link",            [Links::class,              "store"]);
Route::delete("/delete/{id}",   [Links::class,              "delete"])->middleware("auth");
Route::get("/info/{id}",        [Links::class,              "info"])->middleware("auth");
Route::put("status/{id}",       [Links::class,              "linkOff"])->middleware("auth"); 
Route::get("/info",             [function() {
    return redirect("/");
}]);
Route::get('/{string}',         [Links::class, "redirectLink"]); //Deve ficar por último para evitar conflito nas rotas
