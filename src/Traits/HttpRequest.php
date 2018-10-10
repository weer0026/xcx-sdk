<?php

namespace HangJia\Xcx\Traits;

use GuzzleHttp\HandlerStack;

/**
 * @description: request基础trait
 * @author: He Chuan
 */
trait HttpRequest
{
    /**
     * @var
     */
    protected $httpClient;

    /**
     * @var array
     */
    protected $middleware = [];

    /**
     * 默认options
     * @var array
     */
    protected static $defaults = [
        'curl' => [
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
        ],
    ];

    /**
     * request封装
     * @param $url
     * @param string $method
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function request($url, $method = 'GET', $options = [])
    {
        $method = strtoupper($method);
        $options = array_merge(self::$defaults, $options, ['handler' => $this->getHandlerStack()]);
        $response = $this->getHttpClient()->request($method, $url, $options);
        $response->getBody()->rewind();
        return $response;
    }

    /**
     * 获取client 实例
     * @return \GuzzleHttp\Client|\GuzzleHttp\ClientInterface
     */
    public function getHttpClient()
    {
        if (!($this->httpClient instanceof \GuzzleHttp\ClientInterface)) {
            $this->httpClient = new \GuzzleHttp\Client();
        }
        return $this->httpClient;
    }

    public function setHttpClient()
    {

    }

    /**
     * Add a middleware.
     *
     * @param callable $middleware
     * @param null|string $name
     *
     * @return $this
     */
    public function pushMiddleware(callable $middleware, $name = null)
    {
        if (!is_null($name)) {
            $this->middleware[$name] = $middleware;
        } else {
            array_push($this->middleware, $middleware);
        }

        return $this;
    }

    /**
     * Return all middleware.
     *
     * @return array
     */
    public function getMiddleware()
    {
        return $this->middleware;
    }

    /**
     * Build a handler stack.
     *
     * @return \GuzzleHttp\HandlerStack
     */
    public function getHandlerStack()
    {

        $handlerStack = HandlerStack::create();

        foreach ($this->middleware as $name => $middleware) {
            $handlerStack->push($middleware, $name);
        }

        return $handlerStack;
    }
}