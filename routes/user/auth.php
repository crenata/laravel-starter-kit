<?php

use Illuminate\Support\Facades\Route;

Route::post("register", "UserController@register");
Route::post("login", "UserController@login");
