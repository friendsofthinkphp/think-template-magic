# think-template-magic
帮助你在模板上加点魔法

如果你项目模板很多，难于维护，可以使用此工具添加（例如全局样式，javascript，广告等等）。

只适用 ThinkPHP `6.0`

## 安装
```sh
$ composer require xiaodi/think-templte-magic
```

## 使用
例子 添加一个`css`样式
```php
<?php

namespace app;

use xiaodi\Contracts\TemplateMagicHandleInterface;
use xiaodi\Contracts\TemplateMagicReplaceInterface;

class Replace implements TemplateMagicHandleInterface
{
    public function handle(TemplateMagicReplaceInterface $handle)
    {
        $handle->head('<link rel="stylesheet" href="https://static.kodcloud.com/index/js/lib/bootstrap-3.3.7/css/bootstrap.min.css">');
    }
}

```

### 配置
`config/template_magic.php`

```php
use app\Replace;

return [
    'handle' => Replace::class
]
```

支持闭包
```php
use xiaodi\Contracts\TemplateMagicReplaceInterface;

return [
    'handle' => function (TemplateMagicReplaceInterface $handle) {
        $handle->head('<link rel="stylesheet" href="https://static.kodcloud.com/index/js/lib/bootstrap-3.3.7/css/bootstrap.min.css">');
    }
];

```

### func
* `$handle->head($content)` 插入内容到`</head>`标签前
* `$handle->body($content)` 插入内容到`</body>`标签前
