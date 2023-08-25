<?php

declare(strict_types=1);

namespace Tests\Unit\Http;

use EightSleep\Framework\Http\Client\AbstractHttpClient;
use EightSleep\Framework\Http\Enum\HttpStatusCode;

class TestClientHttpClient extends AbstractHttpClient
{
    /**
     * @param string $path
     * @return mixed
     */
    public function sendGet($path)
    {
        return $this->getResponseContent($this->get($path));
    }

    /**
     * @param string $path
     * @param mixed $content
     * @return mixed
     */
    public function sendPost($path, $content = null)
    {
        return $this->getResponseContent($this->post($path, $content));
    }

    /**
     * @param string $path
     * @param mixed $content
     * @return mixed
     */
    public function sendPut($path, $content = null)
    {
        return $this->getResponseContent($this->put($path, $content));
    }

    /**
     * @param string $path
     * @return mixed
     */
    public function sendDelete($path)
    {
        $request = $this->delete($path);
        $request->expectStatusCode(HttpStatusCode::NO_CONTENT());
        return $this->getResponseContent($request);
    }
}
