<?php

namespace xiaodi;

use think\facade\View;
use xiaodi\Contracts\TemplateMagicReplaceInterface;

class TemplateMagic implements TemplateMagicReplaceInterface
{
    const HEAD = '</head>';
    const BODY_BEFORE = '<body>';
    const BODY_AFTER = '</body>';

    /**
     * head标签里追加内容
     *
     * @param [type] $flag
     * @param string $content
     * @return void
     */
    public function head(string $content): void
    {
        $this->replace(self::HEAD, $content);
    }

    /**
     * body标签追加内容
     *
     * @param [type] $flag
     * @param string $content
     * @return void
     */
    public function body(string $content): void
    {
        $this->replace(self::BODY_AFTER, $content);
    }

    /**
     * body标签 头部追加内容
     *
     * @param [type] $content
     * @return void
     */
    public function body_pre($content)
    {
        $this->replace(self::BODY_BEFORE, $content, true);
    }

    /**
     * 指定位置添加内容
     *
     * @param [type] $flag 标签名
     * @param string $content 追加内容
     * @param boolean $reverse true: 追加内容到标签前方 false: 追加内容到标签后方
     * @return void
     */
    public function any($flag, string $content, $reverse = false): void
    {
        $this->replace($flag, $content, $reverse);
    }

    /**
     * Undocumented function
     *
     * @param [type] $flag
     * @param [type] $rp_content
     * @param boolean $reverse
     * @return void
     */
    protected function replace($flag, $rp_content, $reverse = false)
    {
        View::filter(function ($content) use ($flag, $rp_content, $reverse) {
            $pos = strripos($content, $flag);

            if (false !== $pos) {
                $c = [substr($content, 0, $pos), $rp_content];
                if ($reverse) {
                    $c = array_reverse($c);
                }

                return implode($c) . substr($content, $pos);
            }

            return $content . $rp_content;
        });
    }
}
