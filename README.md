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
### 发布
```php
$submit = \HangJia\Xcx\Factory::submit();
$re = $submit->release($app_id, $ext_json);
// 只返回队列号，异步接口，所以查看状态请使用 "发布状态" 接口。
```

### 发布状态
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
