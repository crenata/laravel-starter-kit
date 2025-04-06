<?php

namespace App\Enums;

use App\Traits\EnumTrait;

class ApiEnum {
    use EnumTrait;

    const VERSION = "v1";
    const PREFIX_ADMIN = "admin";
    const PREFIX_USER = "user";
    const PREFIX_AUTH = "auth";
    const PREFIX_SUBSCRIPTION = "subscription";
}
