<?php

declare(strict_types=1);

namespace xiaodi;

use \Closure;
use \Exception;
use think\Service;
use xiaodi\Contracts\TemplateMagicHandleInterface;

class TemplateMagicService  extends Service
{

    /**
     * 注册服务
     *
     * @return mixed
     */
    public function register()
    {
        //
    }


    /**
     * 执行服务
     *
     * @return void
     */
    public function boot()
    {
        $config = config('template_magic');
        if ($config['handle']) {
            if ($config['handle'] instanceof Closure) {
                // TODO
            } else {
                $handle = new $config['handle'];

                if (false === $handle instanceof TemplateMagicHandleInterface) {
                    throw new Exception('class '.$config['handle'] . ' is not instanceof \xiaodi\Contracts\TemplateMagicHandleInterface');
                }

                $magic = new TemplateMagic();
                $handle->handle($magic);
            }
        }
    }
}
