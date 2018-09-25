<?php

namespace HangJia\Xcx;

use HangJia\Xcx\Base\Application;

/**
 * @description:
 * @author: He Chuan
 * @version: 18/9/25 下午1:44
 */
class Auth extends Application
{
    /**
     * 获取小程序授权地址
     * @param $app_id
     * @param $partner_id
     * @param null $note
     * @return string
     */
    public function getAuthUrl($app_id, $partner_id, $note = null)
    {
        $base_url = $this->getConfig()['base_uri'];
        return $base_url . 'util/auth?' . http_build_query(compact('app_id', 'partner_id', 'note'));
    }
}