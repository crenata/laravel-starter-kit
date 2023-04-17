<?php

use App\Constants\TokenConstant;
use Illuminate\Support\Facades\Route;

Route::post("register", "UserController@register");
Route::post("login", "UserController@login");
Route::middleware([TokenConstant::AUTH_SANCTUM, TokenConstant::AUTH_USER])->get("logout", "UserController@logout");
