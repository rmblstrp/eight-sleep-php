<?php

declare(strict_types=1);

namespace EightSleep\Framework\Http\Controller;

use EightSleep\Framework\Domain\Actions\DomainActionInterface;
use EightSleep\Framework\Domain\ClassFactoryInterface;
use EightSleep\Framework\Http\Enum\HttpStatusCode;
use EightSleep\Framework\Http\Operation\CreateResponseFromObject;
use EightSleep\Framework\Http\Operation\GetObjectFromServerRequest;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;

abstract class AbstractDomainActionController
{
    protected LoggerInterface $logger;
    protected ClassFactoryInterface $classFactory;
    protected GetObjectFromServerRequest $deserializeRequestObject;
    protected CreateResponseFromObject $createResponseFromObject;

    public function __construct(
        LoggerInterface $logger,
        ClassFactoryInterface $classFactory,
        GetObjectFromServerRequest $deserializeRequestObject,
        CreateResponseFromObject $createResponseFromObject
    )
    {
        $this->logger = $logger;
        $this->classFactory = $classFactory;
        $this->deserializeRequestObject = $deserializeRequestObject;
        $this->createResponseFromObject = $createResponseFromObject;
    }

    /**
     * @return string
     */
    abstract public function getDomainActionClass(): string;

    /**
     * @return string|null
     */
    abstract public function getDomainObjectClass(): ?string;

    /**
     * @return HttpStatusCode
     */
    public function getDefaultStatusCode(): HttpStatusCode
    {
        return HttpStatusCode::OK();
    }

    /**
     * @return array
     */
    public function getDefaultResponseHeaders(): array
    {
        return [];
    }

    /**
     * @param ServerRequestInterface $request
     * @return array
     */
    public function getDomainLogicParameters(ServerRequestInterface $request): array
    {
        return [];
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->logger->debug(static::class . '::handle - Deserializing Domain Object');
        $requestObject = $this->getRequestObject($request);

        $this->logger->debug(static::class . '::handle - Making Domain Logic');
        /** @var DomainActionInterface $requestLogic */
        $requestLogic = $this->classFactory->make(
            $this->getDomainActionClass(),
            $this->getDomainLogicParameters($request)
        );

        $this->logger->debug(static::class . '::handle - Executing Domain Logic');
        $responseObject = $requestLogic->execute($requestObject, null);

        $this->logger->debug(static::class . '::handle - Creating Response Object');
        return $this->getResponse($responseObject);
    }

    protected function getRequestObject(ServerRequestInterface $request): ?object
    {
        $domainObjectClass = $this->getDomainObjectClass();
        return empty($domainObjectClass)
            ? null
            : $this->deserializeRequestObject->execute($domainObjectClass, $request);
    }

    protected function getResponse(?object $responseObject): ResponseInterface
    {
        return $this->createResponseFromObject->execute(
            $responseObject,
            $this->getDefaultStatusCode(),
            $this->getDefaultResponseHeaders()
        );
    }
}
