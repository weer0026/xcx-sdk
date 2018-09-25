# 航加小程序SDK

## 安装

`composer require hangjia/xcx`

## API文档

### 登录
```php
$user = \HangJia\Xcx\Factory::user();
$re = $user->login();
// 输出
Array {
    'code' => 200,
    'msg' => '',
    'data' => Array {
        'user_name' => 'xxx',
        'app_id' => 13
    }
}
```

### 获取授权地址
```php
$auth = \HangJia\Xcx\Factory::auth();
$url = $auth->getAuthUrl($app_id, $partner_id, $note = null);
// 获取地址后重定向到该地址
```
### 发布
```php
$submit = \HangJia\Xcx\Factory::submit();
$re = $submit->release($app_id, $ext_json);
// 只返回队列号，异步接口，所以查看状态请使用 "发布状态" 接口。
```

### 发布状态
```
状态码字典:

需要弹出授权页面的状态(大于10000)

10001: 未授权

10002：取消授权

10003: 已授权但缺少部分权限（如开发权限）

授权后的状态

-1: 授权后，但是未提交过版本

0: 接受请求，但还没有提交到微信端。

1: 代码审核中

2: 审核通过

3: 审核失败, 检查reason字段获取详细报错信息

4: 已上线

5: 出现错误，检查reason字段获取详细报错信息

6: 撤销审核
```
```php
$submit = \HangJia\Xcx\Factory::submit();
$re = $submit->status($app_id);
// 输出
Array {
    code => 200,
    'msg' => '',
    'data' => Array {
        'status' => 1,
        'version' => '小程序版本号',
        'desc' => '小程序版本备注',
        'reason' => '错误描述', // status 为3，5时候出现
        'platform' => Array { // 本数组显示线上的版本号，上面的数组显示的是你当前提交的版本信息
            'version' => '版本号',
            'desc' => '版本描述'
        }
    }
}
```
