<?php

declare(strict_types=1);

namespace EightSleep\Framework\Http\Client;

use EightSleep\Framework\Http\Enum\HttpStatusCode;
use Psr\Http\Message\RequestInterface;

/**
 * Class HttpClientRequest
 */
class HttpClientRequest
{
    public RequestInterface $request;

    /** @var int[] */
    protected array $expectedStatusCodes = [];

    /**
     * @return int[]
     */
    public function getExpectedStatusCode(): array
    {
        return empty($this->expectedStatusCodes)
            ? [HttpStatusCode::OK]
            : $this->expectedStatusCodes;
    }

    /**
     * @param HttpStatusCode $statusCode
     * @return $this
     */
    public function expectStatusCode(HttpStatusCode $statusCode): self
    {
        $this->expectedStatusCodes[] = $statusCode->getValue();

        return $this;
    }
}
