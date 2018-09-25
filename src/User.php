<?php

namespace HangJia\Xcx;

use GuzzleHttp\Cookie\CookieJar;
use HangJia\Xcx\Base\Application;
use HangJia\Xcx\Base\Util;

/**
 * @description: 用户模块
 * @author: He Chuan
 * @version: 18/8/22 下午2:40
 */
class User extends Application
{
    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function login()
    {
        $config = $this->getConfig();
        $cookies = Util::getCookie();
        $options['cookies'] = CookieJar::fromArray($cookies, $config['cookie_domain']);
        return $this->httpGet('util/login', [], $options);
    }
}