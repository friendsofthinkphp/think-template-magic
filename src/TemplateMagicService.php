<?php

declare(strict_types=1);

namespace xiaodi;

use \Closure;
use \Exception;
use \ReflectionClass;
use think\Service;
use xiaodi\Contracts\TemplateMagicHandleInterface;
use think\Container;

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
    public function boot(TemplateMagic $magic)
    {
        $config = config('template_magic');
        $handle = $config['handle'];

        if (false == empty($handle)) {
            if ($handle instanceof Closure) {
                return Container::getInstance()->invokeFunction($handle, [$magic]);
            }

            $obj = new ReflectionClass($handle);
            if (false === $obj->implementsInterface(TemplateMagicHandleInterface::class)) {
                throw new Exception('class ' . $handle . ' is not instanceof \xiaodi\Contracts\TemplateMagicHandleInterface');
            }

            Container::getInstance()->invokeClass($handle)->handle($magic);
        }
    }
}
