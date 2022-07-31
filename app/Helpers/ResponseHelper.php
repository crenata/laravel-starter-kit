<?php

namespace App\Helpers;

use App\Http\Controllers\Controller;

class ResponseHelper extends Controller {
    public static function response($data = null, $message = "Success", $status = 200) {
        return response()->json([
            "data" => $data,
            "message" => $message,
            "status" => $status
        ], $status);
    }
}
