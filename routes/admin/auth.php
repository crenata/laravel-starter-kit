<?php

use App\Constants\TokenConstant;
use Illuminate\Support\Facades\Route;

Route::middleware([TokenConstant::AUTH_SANCTUM, TokenConstant::AUTH_ADMIN])->group(function () {
    Route::post("register", "AdminController@register");
    Route::get("logout", "AdminController@logout");
});
Route::post("login", "AdminController@login");
