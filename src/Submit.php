<?php

namespace HangJia\Xcx;

use GuzzleHttp\Exception\BadResponseException;
use HangJia\Xcx\Base\Application;

/**
 * @description: 发布功能模块
 * @author: He Chuan
 * @version: 18/8/22 下午2:40
 */
class Submit extends Application
{
    public function status($app_id)
    {
        return $this->httpGet('util/status', ['app_id' => $app_id]);
    }

    /**
     * 小程序上线
     * @param $app_id
     * @param $ext_json
     * @return array
     * @throws Exceptions\BadResponseException
     * @throws \Exception
     */
    public function release($app_id, $ext_json)
    {
        try {
            return $this->httpPost('util/release', compact('app_id', 'ext_json'));
        } catch (BadResponseException $e) {
            throw new \Exception($e->getMessage());
        }
    }
}