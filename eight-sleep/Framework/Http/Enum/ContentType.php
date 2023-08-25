<?php

declare(strict_types=1);

namespace EightSleep\Framework\Http\Enum;

use MabeEnum\Enum;

/**
 * Class ContentType
 *
 * @method static ContentType APPLICATION_JSON()
 * @method static ContentType APPLICATION_PDF()
 * @method static ContentType MULTIPART_FORM_DATA()
 * @method static ContentType TEXT_PLAIN()
 * @method static ContentType TEXT_XML()
 * @method static ContentType WWW_FORM_URL_ENCODED()
 */
class ContentType extends Enum
{
    const APPLICATION_JSON = 'application/json';
    const APPLICATION_PDF = 'application/pdf';
    const MULTIPART_FORM_DATA = 'multipart/form-data';
    const TEXT_PLAIN = 'text/plain';
    const TEXT_XML = 'text/xml';
    const WWW_FORM_URL_ENCODED = 'application/x-www-form-urlencoded';
}
