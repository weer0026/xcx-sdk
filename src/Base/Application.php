<?php

namespace HangJia\Xcx\Base;

use GuzzleHttp\Exception\ServerException;
use HangJia\Xcx\Traits\HttpRequest;
use HangJia\Xcx\Exceptions\BadResponseException;

/**
 * @description: Base Application
 * @author: He Chuan
 * @version: 18/8/22 下午2:51
 */
class Application
{
    use HttpRequest {
        request as performRequest;
    }

    protected $config = [
        'dev' => false,
        'cookie_domain' => 'xcx.hangjiayun.com'
    ];

    protected $defaultConfig = [
        'timeout' => 5.0,
        'base_uri' => 'https://xcx.hangjiayun.com/api/mp/'
    ];

    /**
     * 初始化
     * Application constructor.
     * @param array $config
     */
    public function __construct($config = [])
    {
        $this->config = $config + $this->config;
    }

    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param $url
     * @param string $method
     * @param array $options
     * @throws BadResponseException
     * @return array
     */
    public function request($url, $method = 'GET', $options = [])
    {
        $options = array_merge($this->defaultConfig, $options);
        try {
            $response = $this->performRequest($url, $method, $options);
        } catch (ServerException $e) {
            $response = $this->toArray($e->getResponse());
            $msg = isset($response['msg']) && $response['msg'] ? var_export($response, true) : null;
            throw new BadResponseException('出现错误：' . $msg);
        }
        $response = $this->toArray($response);
        $code = isset($response['code']) && $response['code'] ? $response['code'] : null;

        if ($code === 200) {
            return $response;
        } else {
            $msg = isset($response['msg']) && $response['msg'] ? var_export($response, true) : null;
            throw new BadResponseException('出现错误：' . $msg);
        }
    }

    /**
     * get 请求
     * @param $url
     * @param $params
     * @throws
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function httpGet($url, $params = [], $options = [])
    {
        $options = ['query' => $params] + $options;
        return $this->request($url, 'GET', $options);
    }

    /**
     * POST request.
     * @param string $url
     * @param array $data
     * @param array $params
     * @throws BadResponseException
     * @return array
     */
    public function httpPost($url, array $data = [], array $params = [])
    {
        return $this->request($url, 'POST', ['query' => $params, 'form_params' => $data]);
    }

    /**
     * @param $response
     * @return string
     */
    public function getBodyContents(\Psr\Http\Message\ResponseInterface $response)
    {
        $response->getBody()->rewind();
        $contents = $response->getBody()->getContents();
        $response->getBody()->rewind();

        return $contents;
    }

    /**
     * @param $response
     * @return array
     */
    private function toArray($response)
    {
        $content = $this->getBodyContents($response);
        $array = json_decode($content, true);

        if (JSON_ERROR_NONE === json_last_error()) {
            return (array)$array;
        }

        return [];
    }
}