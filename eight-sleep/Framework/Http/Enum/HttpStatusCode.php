<?php

declare(strict_types=1);

namespace EightSleep\Framework\Http\Enum;

use MabeEnum\Enum;

/**
 * Class HttpStatusCode
 *
 * @method static HttpStatusCode CONTINUED()
 * @method static HttpStatusCode SWITCHING_PROTOCOLS()
 * @method static HttpStatusCode PROCESSING()
 * @method static HttpStatusCode EARLY_HINTS()
 * @method static HttpStatusCode OK()
 * @method static HttpStatusCode CREATED()
 * @method static HttpStatusCode ACCEPTED()
 * @method static HttpStatusCode ACCEPTED_NON_AUTHORITATIVE_INFORMATION()
 * @method static HttpStatusCode NO_CONTENT()
 * @method static HttpStatusCode RESET_CONTENT()
 * @method static HttpStatusCode PARTIAL_CONTENT()
 * @method static HttpStatusCode MULTI_STATUS()
 * @method static HttpStatusCode ALREADY_REPORTED()
 * @method static HttpStatusCode IM_USED()
 * @method static HttpStatusCode MULTIPLE_CHOICES()
 * @method static HttpStatusCode MOVED_PERMANENTLY()
 * @method static HttpStatusCode FOUND()
 * @method static HttpStatusCode SEE_OTHER()
 * @method static HttpStatusCode NOT_MODIFIED()
 * @method static HttpStatusCode USE_PROXY()
 * @method static HttpStatusCode SWITCH_PROXY()
 * @method static HttpStatusCode TEMPORARY_REDIRECT()
 * @method static HttpStatusCode PERMANENT_REDIRECT()
 * @method static HttpStatusCode BAD_REQUEST()
 * @method static HttpStatusCode UNAUTHORIZED()
 * @method static HttpStatusCode PAYMENT_REQUIRED()
 * @method static HttpStatusCode FORBIDDEN()
 * @method static HttpStatusCode NOT_FOUND()
 * @method static HttpStatusCode METHOD_NOT_ALLOWED()
 * @method static HttpStatusCode NOT_ACCEPTABLE()
 * @method static HttpStatusCode PROXY_AUTHENTICATION_REQUIRED()
 * @method static HttpStatusCode REQUEST_TIMEOUT()
 * @method static HttpStatusCode CONFLICT()
 * @method static HttpStatusCode GONE()
 * @method static HttpStatusCode LENGTH_REQUIRED()
 * @method static HttpStatusCode PRECONDITION_FAILED()
 * @method static HttpStatusCode PAYLOAD_TOO_LARGE()
 * @method static HttpStatusCode URI_TOO_LONG()
 * @method static HttpStatusCode UNSUPPORTED_MEDIA_TYPE()
 * @method static HttpStatusCode RANGE_NOT_SATISFIABLE()
 * @method static HttpStatusCode EXPECTATION_FAILED()
 * @method static HttpStatusCode IM_A_TEAPOT()
 * @method static HttpStatusCode MISDIRECTED_REQUEST()
 * @method static HttpStatusCode UNPROCESSABLE_ENTITY()
 * @method static HttpStatusCode LOCKED()
 * @method static HttpStatusCode FAILED_DEPENDENCY()
 * @method static HttpStatusCode UPGRADE_REQUIRED()
 * @method static HttpStatusCode PRECONDITION_REQUIRED()
 * @method static HttpStatusCode TOO_MANY_REQUESTS()
 * @method static HttpStatusCode REQUEST_HEADER_FIELDS_TOO_LARGE()
 * @method static HttpStatusCode UNAVAILABLE_FOR_LEGAL_REASONS()
 * @method static HttpStatusCode INTERNAL_SERVER_ERROR()
 * @method static HttpStatusCode NOT_IMPLEMENTED()
 * @method static HttpStatusCode BAD_GATEWAY()
 * @method static HttpStatusCode SERVICE_UNAVAILABLE()
 * @method static HttpStatusCode GATEWAY_TIMEOUT()
 * @method static HttpStatusCode HTTP_VERSION_NOT_SUPPORTED()
 * @method static HttpStatusCode VARIANT_ALSO_NEGOTIATES()
 * @method static HttpStatusCode INSUFFICIENT_STORAGE()
 * @method static HttpStatusCode LOOP_DETECTED()
 * @method static HttpStatusCode NOT_EXTENDED()
 * @method static HttpStatusCode NETWORK_AUTHENTICATION_REQUIRED()
 * @method static HttpStatusCode PASS_ERROR_MESSAGE_TO_MOBILE
 */
class HttpStatusCode extends Enum
{
    const CONTINUED = 100;
    const SWITCHING_PROTOCOLS = 101;
    const PROCESSING = 102;
    const EARLY_HINTS = 103;

    const OK = 200;
    const CREATED = 201;
    const ACCEPTED = 202;
    const ACCEPTED_NON_AUTHORITATIVE_INFORMATION = 203;
    const NO_CONTENT = 204;
    const RESET_CONTENT = 205;
    const PARTIAL_CONTENT = 206;
    const MULTI_STATUS = 207;
    const ALREADY_REPORTED = 208;
    const IM_USED = 226;

    const MULTIPLE_CHOICES = 300;
    const MOVED_PERMANENTLY = 301;
    const FOUND = 302;
    const SEE_OTHER = 303;
    const NOT_MODIFIED = 304;
    const USE_PROXY = 305;
    const SWITCH_PROXY = 306;
    const TEMPORARY_REDIRECT = 307;
    const PERMANENT_REDIRECT = 308;

    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const PAYMENT_REQUIRED = 402;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;
    const METHOD_NOT_ALLOWED = 405;
    const NOT_ACCEPTABLE = 406;
    const PROXY_AUTHENTICATION_REQUIRED = 407;
    const REQUEST_TIMEOUT = 408;
    const CONFLICT = 409;
    const GONE = 410;
    const LENGTH_REQUIRED = 411;
    const PRECONDITION_FAILED = 412;
    const PAYLOAD_TOO_LARGE = 413;
    const URI_TOO_LONG = 414;
    const UNSUPPORTED_MEDIA_TYPE = 415;
    const RANGE_NOT_SATISFIABLE = 416;
    const EXPECTATION_FAILED = 417;
    const IM_A_TEAPOT = 418;
    const MISDIRECTED_REQUEST = 421;
    const UNPROCESSABLE_ENTITY = 422;
    const LOCKED = 423;
    const FAILED_DEPENDENCY = 424;
    const UPGRADE_REQUIRED = 426;
    const PRECONDITION_REQUIRED = 428;
    const TOO_MANY_REQUESTS = 429;
    const REQUEST_HEADER_FIELDS_TOO_LARGE = 431;
    const UNAVAILABLE_FOR_LEGAL_REASONS  = 451;

    const INTERNAL_SERVER_ERROR = 500;
    const NOT_IMPLEMENTED = 501;
    const BAD_GATEWAY = 502;
    const SERVICE_UNAVAILABLE = 503;
    const GATEWAY_TIMEOUT = 504;
    const HTTP_VERSION_NOT_SUPPORTED = 505;
    const VARIANT_ALSO_NEGOTIATES = 506;
    const INSUFFICIENT_STORAGE = 507;
    const LOOP_DETECTED = 508;
    const NOT_EXTENDED = 510;
    const NETWORK_AUTHENTICATION_REQUIRED = 511;
    
    const PASS_ERROR_MESSAGE_TO_MOBILE = 777;
}
