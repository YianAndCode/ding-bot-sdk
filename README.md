# Ding Bot SDK

钉钉群机器人开发工具

## 安装

```bash
composer require yian/ding-bot-sdk
```

## 使用

```PHP
<?php

use Ding\Bot;

$url = 'Your bot webhook url';    // 机器人地址
$options = [
    'secret' => "Your secret",    // 如果安全设置中勾选了“加签”，则需要提供
];
$bot = new Bot($url, $options);

$msg = [
    'msgtype' => 'text',
    'text' => [
        'content' => '大家好',
    ],
];

var_dump($bot->send($msg));
// string(27) "{"errcode":0,"errmsg":"ok"}"
```