<?php

namespace HangJia\Xcx;

use HangJia\Xcx\Base\Application;
use HangJia\Xcx\Middleware\AesSignMiddleware;

/**
 * @description: 合作商平台级API
 * @author: He Chuan
 * @version: 18/10/10 下午1:40
 */
class Platform extends Application
{
    /**
     * 增加签名中间件
     * Platform constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config);

        if (!isset($config['secret_key'])) {
            throw new \InvalidArgumentException('参数错误');
        }
        $this->pushMiddleware((new AesSignMiddleware())->applyRequest($config['secret_key']), 'aes_sign');
    }

    /**
     * 获取component access token
     * @param $partner_id integer 代理商ID
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getToken($partner_id)
    {
        return $this->httpGet('open/token', ['partner_id' => $partner_id]);
    }
}