<?php

namespace App\Http\Controllers\Auth;

use App\Constants\TokenConstant;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\AdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller {
    protected $adminTable;

    public function __construct() {
        $this->adminTable = (new AdminModel())->getTable();
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            "name" => "required|string",
            "email" => "required|string|email|unique:$this->adminTable,email",
            "password" => "required|string|min:8",
            "confirm_password" => "required|string|min:8|same:password"
        ]);
        if ($validator->fails()) return ResponseHelper::response(null, $validator->errors()->first(), 400);

        $user = AdminModel::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        return ResponseHelper::response([
            "user" => $user,
            "token" => $user->createToken(TokenConstant::TOKEN_NAME, [TokenConstant::AUTH_ADMIN])->plainTextToken
        ]);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            "email" => "required|string|email|exists:$this->adminTable,email",
            "password" => "required|string|min:8",
        ]);
        if ($validator->fails()) return ResponseHelper::response(null, $validator->errors()->first(), 400);

        $user = AdminModel::where("email", $request->email)->first();

        if (empty($user->id) || !Hash::check($request->password, $user->password)) return ResponseHelper::response(null, "The provided credentials are incorrect.", 401);

        return ResponseHelper::response([
            "user" => $user,
            "token" => $user->createToken(TokenConstant::TOKEN_NAME, [TokenConstant::AUTH_ADMIN])->plainTextToken
        ]);
    }
}
