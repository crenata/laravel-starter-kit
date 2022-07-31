<?php

use Illuminate\Support\Facades\Route;

Route::prefix("auth")->namespace("Auth")->group(__DIR__ . "/auth.php");
