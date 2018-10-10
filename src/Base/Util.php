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

    /**
     * 生成签名
     * @param $params
     * @param $secret_key string 密钥
     * @return string
     */
    public static function makeSign($params, $secret_key)
    {
        sort($params, SORT_STRING);
        $params['key'] = $secret_key;
        $str = implode($params);
        return sha1($str);
    }

    /**
     * 生成随机数
     * @param int $length
     * @return string
     */
    public static function genRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}