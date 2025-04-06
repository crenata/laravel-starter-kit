<?php

use App\Enums\ApiEnum;
use App\Enums\TokenEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix(ApiEnum::VERSION)
    ->namespace("App\Http\Controllers")
    ->group(function () {
        Route::prefix(ApiEnum::PREFIX_ADMIN)->group(__DIR__ . "/" . ApiEnum::PREFIX_ADMIN . "/api.php");
        Route::prefix(ApiEnum::PREFIX_USER)->group(__DIR__ . "/" . ApiEnum::PREFIX_USER . "/api.php");
        Route::middleware([TokenEnum::AUTH_SANCTUM])
            ->prefix(ApiEnum::PREFIX_SUBSCRIPTION)
            ->namespace("Subscriptions")
            ->group(__DIR__ . "/subscription.php");
});
