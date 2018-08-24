<?php

namespace HangJia\Xcx\Base;

/**
 * @description:
 * @author: He Chuan
 * @version: 18/8/22 下午4:46
 */
class Util
{
    /**
     * 获取cookie,并进行url编码，防止cookie拆分。
     * @return array
     */
    public static function getCookie()
    {
        $cookie = [];
        foreach ($_COOKIE as $name => $value) {
            $cookie[$name] = urlencode($value);
        }
        return $cookie;
    }
}