<?php

declare(strict_types=1);

namespace Tests\Unit\Http;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ApiClient extends TestClientHttpClient
{
    protected function getExecutionResponse(ClientInterface $client, RequestInterface $request): ResponseInterface
    {
        $key = sprintf(
            '[methods][%s][%s]',
            $request->getMethod(),
            $request->getUri()->getPath()
        );

        $testValues = $this->getConfigValue($key);

        if ($testValues === null) {
            return new Response(404, [], $request->getUri());
        }

        return new Response($testValues['status'], [], $this->propertyAccessor->getValue($testValues, '[content]'));
    }
}
