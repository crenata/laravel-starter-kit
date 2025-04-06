<?php

use App\Constants\ApiEnum;
use Illuminate\Support\Facades\Route;

Route::prefix(ApiEnum::PREFIX_AUTH)
    ->namespace(ucfirst(ApiEnum::PREFIX_AUTH))
    ->group(__DIR__ . "/" . ApiEnum::PREFIX_AUTH . ".php");
