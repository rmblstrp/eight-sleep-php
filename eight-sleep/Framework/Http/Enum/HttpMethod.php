<?php

declare(strict_types=1);

namespace EightSleep\Framework\Http\Enum;

use MabeEnum\Enum;

/**
 * Class HttpMethod
 *
 * @method static HttpMethod DELETE()
 * @method static HttpMethod GET()
 * @method static HttpMethod HEAD()
 * @method static HttpMethod OPTIONS()
 * @method static HttpMethod PATCH()
 * @method static HttpMethod POST()
 * @method static HttpMethod PURGE()
 * @method static HttpMethod PUT()
 * @method static HttpMethod TRACE()
 */
class HttpMethod extends Enum
{
    const DELETE = 'DELETE';
    const GET = 'GET';
    const HEAD = 'HEAD';
    const OPTIONS = 'OPTIONS';
    const PATCH = 'PATCH';
    const POST = 'POST';
    const PURGE = 'PURGE';
    const PUT = 'PUT';
    const TRACE = 'TRACE';
}
