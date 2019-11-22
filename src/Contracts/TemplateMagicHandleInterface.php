<?php

declare(strict_types=1);

namespace xiaodi\Contracts;

use xiaodi\Contracts\TemplateMagicReplaceInterface;

interface TemplateMagicHandleInterface
{
    public function handle(TemplateMagicReplaceInterface $handle);
}
