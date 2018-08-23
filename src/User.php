<?php

namespace HangJia\Xcx;

use GuzzleHttp\Cookie\CookieJar;
use HangJia\Xcx\Base\Application;

/**
 * @description:
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
        $options['cookies'] = CookieJar::fromArray($_COOKIE, $config['cookie_domain']);
        return $this->httpGet('api/mp/util/login', [], []);
    }
}