<?php

namespace HangJia\Xcx\Middleware;

use HangJia\Xcx\Base\Util;
use Psr\Http\Message\RequestInterface;

/**
 * @description: AES加密中间件，附加参数在get参数中
 * @author: He Chuan
 * @version: 18/10/10 下午3:31
 */
class AesSignMiddleware
{
    public function applyRequest($secret_key)
    {
        return function (callable $handler) use ($secret_key) {
            return function (RequestInterface $request, array $options) use ($handler, $secret_key) {
                parse_str($request->getUri()->getQuery(), $query);
                $query = http_build_query($this->getQuery($query, $secret_key));
                $request = $request->withUri($request->getUri()->withQuery($query));
                return $handler($request, $options);
            };
        };
    }

    private function getQuery($query, $secret_key)
    {
        $query['timestamp'] = time();
        $query['nonce'] = Util::genRandomString();
        $query['sign'] = Util::makeSign($query, $secret_key);
        return $query;
    }
}