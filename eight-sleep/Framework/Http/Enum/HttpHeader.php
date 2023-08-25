<?php

declare(strict_types=1);

namespace EightSleep\Framework\Http\Enum;

use MabeEnum\Enum;

/**
 * Class HttpHeader
 *
 * @method static HttpHeader ACCEPT()
 * @method static HttpHeader ACCEPT_CHARSET()
 * @method static HttpHeader ACCEPT_ENCODING()
 * @method static HttpHeader ACCEPT_LANGUAGE()
 * @method static HttpHeader ACCESS_CONTROL_REQUEST_METHOD()
 * @method static HttpHeader ACCESS_CONTROL_REQUEST_HEADERS()
 * @method static HttpHeader ACCESS_CONTROL_ALLOW_ORIGIN()
 * @method static HttpHeader ACCESS_CONTROL_ALLOW_CREDENTIALS()
 * @method static HttpHeader ACCESS_CONTROL_EXPOSE_HEADERS()
 * @method static HttpHeader ACCESS_CONTROL_MAX_AGE()
 * @method static HttpHeader ACCESS_CONTROL_ALLOW_METHODS()
 * @method static HttpHeader ACCESS_CONTROL_ALLOW_HEADERS()
 * @method static HttpHeader ALLOW()
 * @method static HttpHeader AUTHORIZATION()
 * @method static HttpHeader CONTENT_LENGTH()
 * @method static HttpHeader CACHE_CONTROL()
 * @method static HttpHeader CONTENT_ENCODING()
 * @method static HttpHeader CONTENT_LANGUAGE()
 * @method static HttpHeader CONTENT_TYPE()
 * @method static HttpHeader COOKIE()
 * @method static HttpHeader EXPIRES()
 * @method static HttpHeader PRAGMA()
 * @method static HttpHeader SET_COOKIE()
 * @method static HttpHeader USER_AGENT()
 * @method static HttpHeader WWW_AUTHENTICATE()
 * @method static HttpHeader X_CSRF_TOKEN()
 */
class HttpHeader extends Enum
{
    const ACCEPT                           = 'Accept';
    const ACCEPT_CHARSET                   = 'Accept-Charset';
    const ACCEPT_ENCODING                  = 'Accept-Encoding';
    const ACCEPT_LANGUAGE                  = 'Accept-Language';
    const ACCESS_CONTROL_REQUEST_METHOD    = 'Access-Control-Request-Method';
    const ACCESS_CONTROL_REQUEST_HEADERS   = 'Access-Control-Request-Headers';
    const ACCESS_CONTROL_ALLOW_ORIGIN      = 'Access-Control-Allow-Origin';
    const ACCESS_CONTROL_ALLOW_CREDENTIALS = 'Access-Control-Allow-Credentials';
    const ACCESS_CONTROL_EXPOSE_HEADERS    = 'Access-Control-Expose-Headers';
    const ACCESS_CONTROL_MAX_AGE           = 'Access-Control-Max-Age';
    const ACCESS_CONTROL_ALLOW_METHODS     = 'Access-Control-Allow-Methods';
    const ACCESS_CONTROL_ALLOW_HEADERS     = 'Access-Control-Allow-Headers';
    const ALLOW                            = 'Allow';
    const AUTHORIZATION                    = 'Authorization';
    const CONTENT_LENGTH                   = 'Content-Length';
    const CACHE_CONTROL                    = 'Cache-Control';
    const CONTENT_ENCODING                 = 'Content-Encoding';
    const CONTENT_LANGUAGE                 = 'Content-Language';
    const CONTENT_TYPE                     = 'Content-Type';
    const COOKIE                           = 'Cookie';
    const EXPIRES                          = 'Expires';
    const PRAGMA                           = 'Pragma';
    const SET_COOKIE                       = 'Set-Cookie';
    const USER_AGENT                       = 'User-Agent';
    const WWW_AUTHENTICATE                 = 'WWW-Authenticate';
    const X_CSRF_TOKEN                     = 'X-Csrf-Token';
}
