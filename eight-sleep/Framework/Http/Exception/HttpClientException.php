<?php

declare(strict_types=1);

namespace EightSleep\Framework\Http\Exception;

use Exception;
use Psr\Http\Message\ResponseInterface;

/**
 * Class HttpClientException
 */
class HttpClientException extends Exception
{
    /**
     * @var ResponseInterface|null
     */
    protected ?ResponseInterface $httpResponse = null;

    /**
     * @return ResponseInterface|null
     */
    public function getHttpResponse()
    {
        return $this->httpResponse;
    }

    /**
     * @return bool
     */
    public function hasHttpResponse()
    {
        return $this->httpResponse instanceof ResponseInterface;
    }

    /**
     * @param ResponseInterface|null $response
     * @return $this
     */
    public function withHttpResponse(ResponseInterface $response = null)
    {
        $this->httpResponse = $response;

        return $this;
    }
}
