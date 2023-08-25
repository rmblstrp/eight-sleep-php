<?php

declare(strict_types=1);

namespace EightSleep\Framework\Http\Client;

use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Request;
use EightSleep\Framework\Http\Enum\ContentType;
use EightSleep\Framework\Http\Enum\HttpMethod;
use EightSleep\Framework\Http\Exception\HttpClientException;
use EightSleep\Framework\Http\Exception\HttpClientTimeoutException;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

/**
 * Class HttpClient
 */
abstract class AbstractHttpClient
{
    protected LoggerInterface $logger;
    protected ClientInterface $httpClient;
    protected array $config;
    protected ?ResponseInterface $lastResponse;
    protected int $timeoutDefault = 10;
    protected ?PropertyAccessor $propertyAccessor;

    //------------------------------------------------------------------------------------------------------------------

    /**
     * @param LoggerInterface $logger
     * @param ClientInterface $client
     * @param array $config
     */
    public function __construct(LoggerInterface $logger, ClientInterface $client, array $config = [])
    {
        $this->logger = $logger;
        $this->httpClient = $client;
        $this->config = $config;
        $this->propertyAccessor = PropertyAccess::createPropertyAccessor();
    }

    //------------------------------------------------------------------------------------------------------------------

    protected function getConfigValue(string $key, $default = null)
    {
        $value = $this->propertyAccessor->getValue($this->config, $key);
        return $value === null ? $default : $value;
    }

    //------------------------------------------------------------------------------------------------------------------

    protected function createRequest(HttpMethod $method, string $uri, ?string $content = null): HttpClientRequest
    {
        $url = $this->getConfigValue('[base][uri]') . $uri;
        $headers = $this->getConfigValue('[headers]', []);

        $headers = array_merge($headers, $this->getAdditionalHeaders());

        $clientRequest = new HttpClientRequest();
        $clientRequest->request = new Request($method->getValue(), $url, $headers, $content);

        return $clientRequest;
    }

    /**
     * return array
     */
    protected function getAdditionalHeaders(): array
    {
        return ['Accept' => ContentType::APPLICATION_JSON];
    }

    protected function getBodyContents(MessageInterface $message): ?string
    {
        $body = $message->getBody();
        $position = $body->tell();
        $body->rewind();
        $contents = $body->getContents();
        $body->seek($position);

        return empty($contents) ? null : $contents;
    }

    //------------------------------------------------------------------------------------------------------------------

    protected function getResponseContent(HttpClientRequest $clientRequest): string
    {
        return $this->getBodyContents($this->executeRequest($clientRequest));
    }

    protected function executeRequest(HttpClientRequest $clientRequest): ResponseInterface
    {
        $response = null;
        $exception = null;

        $startTime = microtime(true);
        try {
            $response = $this->getExecutionResponse($this->httpClient, $clientRequest->request);
            $this->onResponse($clientRequest, $response);
        }
        catch (Exception $e) {
            $exception = $e;
        }
        $executionTime = microtime(true) - $startTime;

        $this->lastResponse = $response;
        $this->afterRequestExecution($clientRequest, $executionTime);

        if ($exception instanceof Exception || !in_array($response->getStatusCode(), $clientRequest->getExpectedStatusCode())) {
            if ($response instanceof ResponseInterface) {
                $message = $response->getReasonPhrase();
                $code = $response->getStatusCode();
            }
            else {
                $message = 'Unknown Error';
                $code = 0;
            }

            $clientException = $exception instanceof ConnectException
                ? new HttpClientTimeoutException('Connection timeout', 0, $exception)
                : new HttpClientException($message, $code, $exception);

            $clientException->withHttpResponse($response);
            $this->onException($clientException);

            throw $clientException;
        }

        return $response;
    }

    protected function afterRequestExecution(HttpClientRequest $clientRequest, float $executionTime)
    {
    }

    protected function onException(HttpClientException $exception)
    {
    }

    protected function onResponse(HttpClientRequest $clientRequest, ResponseInterface $response)
    {
    }

    /**
     * Execute the request and return a response. This method was made so that it
     * could be overridden to return custom responses for unit testing.
     */
    protected function getExecutionResponse(ClientInterface $client, RequestInterface $request): ResponseInterface
    {
        return $client->send($request);
    }

    //------------------------------------------------------------------------------------------------------------------

    protected function delete(string $uri): HttpClientRequest
    {
        return $this->createRequest(HttpMethod::DELETE(), $uri);
    }

    protected function get(string $uri): HttpClientRequest
    {
        return $this->createRequest(HttpMethod::byValue(HttpMethod::GET), $uri);
    }

    protected function post(string $uri, ?string $content = null): HttpClientRequest
    {
        return $this->createRequest(HttpMethod::POST(), $uri, $content);
    }

    protected function put(string $uri, ?string $content = null): HttpClientRequest
    {
        return $this->createRequest(HttpMethod::PUT(), $uri, $content);
    }
}
