<?php

use Illuminate\Support\Facades\Route;

Route::post("send", "PushSubscriptionController@sendNotification");
Route::post("update", "PushSubscriptionController@update");
Route::post("delete", "PushSubscriptionController@delete");
