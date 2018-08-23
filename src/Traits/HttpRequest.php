<?php

namespace HangJia\Open\Traits;

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
        $options = array_merge(self::$defaults, $options);
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

}