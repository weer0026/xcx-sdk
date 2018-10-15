<?php

use PHPUnit\Framework\TestCase;

/**
 * @description:
 * @author: He Chuan
 * @version: 18/10/10 下午2:46
 */
class PlatformTest extends TestCase
{
    /**
     * 获取授权链接
     */
    public function testAuthUrl()
    {
        $platform = \HangJia\Xcx\Factory::platform([
            'secret_key' => ''
        ]);
        $ret = $platform->getToken(1);
        var_dump($ret);
        $this->assertArrayHasKey('component_access_token', $ret['data']);
    }
}