<?php

declare(strict_types=1);

namespace EightSleep\Framework\Http\Operation;

use EightSleep\Framework\Domain\ClassFactoryInterface;
use EightSleep\Framework\Domain\Operations\AbstractDomainOperation;
use EightSleep\Framework\Serialization\Json\Operation\GetObjectFromJson;
use Nyholm\Psr7\Uri;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;

class GetObjectFromServerRequest extends AbstractDomainOperation
{
    protected GetObjectFromJson $getObjectFromJson;

    /**
     * @param LoggerInterface $logger
     * @param GetObjectFromJson $getObjectFromJson
     */
    public function __construct(LoggerInterface $logger, GetObjectFromJson $getObjectFromJson)
    {
        parent::__construct($logger);
        $this->getObjectFromJson = $getObjectFromJson;
    }

    /**
     * @param string $class
     * @param ServerRequestInterface $request
     * @return object|null
     */
    public function execute(string $class, ServerRequestInterface $request): ?object
    {
        if ($request->getMethod() === 'GET' || $request->getMethod() === 'DELETE') {
            $severParameters = $request->getServerParams();
            $uri = new Uri($severParameters['REQUEST_URI']);
            \parse_str($uri->getQuery(), $parameters);
            $this->logger->debug('Getting parameters from query string', $parameters);
            return $this->getObjectFromJson->execute($class, json_encode($parameters));
        }

        $contentTypeHeaders = $request->getHeader('Content-Type');
        if ($contentTypeHeaders == null || count($contentTypeHeaders) < 1) {
            $contentType = null;
        }
        else {
            $contentType = $contentTypeHeaders[0];

            $position = strpos($contentType, ';');
            if ($position !== false) {
                $contentType = substr($contentType, 0, $position);
            }
        }

        $json = $request->getBody()->getContents();
        $this->logger->debug(self::class . '::execute', [
            'class' => $class,
            'request' => $request,
            'json' => $json,
        ]);

        switch ($contentType) {
            case 'application/json':
                return $this->getObjectFromJson->execute($class, $json);
            case 'application/x-www-form-urlencoded':
            case 'multipart/form-data':
                $parameters = array_merge($request->getParsedBody(), $request->getUploadedFiles());
                return $this->getObjectFromJson->execute($class, json_encode($parameters));
        }

        throw new \Exception('Unknown content type');
    }
}
