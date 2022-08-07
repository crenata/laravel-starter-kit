<?php

use App\Constants\TokenConstant;
use Illuminate\Support\Facades\Route;

Route::middleware([TokenConstant::AUTH_SANCTUM, TokenConstant::AUTH_ADMIN])->post("register", "AdminController@register");
Route::post("login", "AdminController@login");
