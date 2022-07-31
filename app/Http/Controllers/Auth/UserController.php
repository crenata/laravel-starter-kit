<?php

namespace App\Http\Controllers\Auth;

use App\Constants\TokenConstant;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {
    protected $userTable;

    public function __construct() {
        $this->userTable = (new UserModel())->getTable();
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email|unique:$this->userTable,email",
            "password" => "required|min:8",
            "confirm_password" => "required|same:password|min:8"
        ]);
        if ($validator->fails()) return ResponseHelper::response(null, $validator->errors()->first(), 400);

        $user = UserModel::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        return ResponseHelper::response([
            "user" => $user,
            "token" => $user->createToken(TokenConstant::TOKEN_NAME, [TokenConstant::AUTH_USER])->plainTextToken
        ]);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            "email" => "required|email|exists:$this->userTable,email",
            "password" => "required|min:8",
        ]);
        if ($validator->fails()) return ResponseHelper::response(null, $validator->errors()->first(), 400);

        $user = UserModel::where("email", $request->email)->first();

        if (empty($user->id) || !Hash::check($request->password, $user->password)) return ResponseHelper::response(null, "The provided credentials are incorrect.", 401);

        return ResponseHelper::response([
            "user" => $user,
            "token" => $user->createToken(TokenConstant::TOKEN_NAME, [TokenConstant::AUTH_USER])->plainTextToken
        ]);
    }
}
