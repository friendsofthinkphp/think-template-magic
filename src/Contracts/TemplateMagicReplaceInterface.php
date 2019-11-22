<?php

namespace xiaodi\Contracts;

interface TemplateMagicReplaceInterface
{
    public function head(string $content): void;
    public function body(string $content): void;
    public function any(string $flag, string $content): void;
}
