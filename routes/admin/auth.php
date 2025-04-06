<?php

use App\Constants\TokenEnum;
use Illuminate\Support\Facades\Route;

Route::middleware([TokenEnum::AUTH_SANCTUM, TokenEnum::AUTH_ADMIN])->group(function () {
    Route::post("register", "AdminController@register");
    Route::get("logout", "AdminController@logout");
});
Route::post("login", "AdminController@login");
