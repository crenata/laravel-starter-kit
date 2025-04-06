<?php

use App\Constants\TokenEnum;
use Illuminate\Support\Facades\Route;

Route::post("register", "UserController@register");
Route::post("login", "UserController@login");
Route::middleware([TokenEnum::AUTH_SANCTUM, TokenEnum::AUTH_USER])->get("logout", "UserController@logout");
