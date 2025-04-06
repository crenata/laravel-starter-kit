<?php

namespace App\Enums;

use App\Traits\EnumTrait;

class TokenEnum {
    use EnumTrait;

    const TOKEN_NAME = "token";
    const AUTH_SANCTUM = "auth:sanctum";
    const AUTH_ADMIN = "auth.admin";
    const AUTH_USER = "auth.user";
}
