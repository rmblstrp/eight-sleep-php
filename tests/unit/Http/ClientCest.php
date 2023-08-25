<?php

declare(strict_types=1);

namespace Tests\Unit\Http;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Request;
use EightSleep\Framework\Http\Enum\HttpMethod;
use EightSleep\Framework\Http\Exception\HttpClientException;
use EightSleep\Framework\Http\Exception\HttpClientTimeoutException;
use Mockery;
use UnitTester;

class ClientCest
{
    /** @var array */
    private $config = [
        'base' => [
            'uri' => 'http://localhost',
        ],
        'proxy' => [
            'enabled' => true,
            'host' => 'http://localhost:8080'
        ]
    ];

    /**
     * @param UnitTester $I
     */
    public function unexpectedStatusCode(UnitTester $I)
    {
        $settings = [
            'methods' => [
                HttpMethod::GET => [
                    '/test' => [
                        'status' => 401,
                        'content' => 'hello',
                    ],
                ],
            ],
        ];

        $client = new ApiClient(array_merge($this->config, $settings));
        $I->expectThrowable(HttpClientException::class, function () use ($client) {
            $client->sendGet('/test');
        });

        try {
            $client->sendGet('/test');
        }
        catch (HttpClientException $e) {
            $I->assertTrue($e->hasHttpResponse());
            $I->assertSame(401, $e->getHttpResponse()->getStatusCode());
        }
    }
}
