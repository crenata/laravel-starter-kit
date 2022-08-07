<?php

namespace App\Http\Controllers\Subscriptions;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Notifications\PushSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PushSubscriptionController extends Controller {
    public function sendNotification(Request $request) {
        auth()->user()->notify(new PushSubscription());
        return ResponseHelper::response();
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            "endpoint" => "required"
        ]);
        if ($validator->fails()) return ResponseHelper::response(null, $validator->errors()->first(), 400);

        auth()->user()->updatePushSubscription(
            $request->endpoint,
            $request->public_key,
            $request->auth_token,
            $request->content_encoding
        );

        return ResponseHelper::response();
    }

    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            "endpoint" => "required"
        ]);
        if ($validator->fails()) return ResponseHelper::response(null, $validator->errors()->first(), 400);

        auth()->user()->deletePushSubscription($request->endpoint);

        return ResponseHelper::response();
    }
}
