<?php

namespace App\Enums;

use App\Traits\EnumTrait;

class HttpMethodEnum {
    use EnumTrait;

    const GET = "GET";
    const POST = "POST";
    const PUT = "PUT";
    const PATCH = "PATCH";
    const DELETE = "DELETE";
    const COPY = "COPY";
    const HEAD = "HEAD";
    const OPTIONS = "OPTIONS";
    const LINK = "LINK";
    const UNLINK = "UNLINK";
    const PURGE = "PURGE";
    const LOCK = "LOCK";
    const UNLOCK = "UNLOCK";
    const PROPFIND = "PROPFIND";
    const VIEW = "VIEW";
}
