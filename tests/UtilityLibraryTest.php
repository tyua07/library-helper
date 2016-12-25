<?php

// +----------------------------------------------------------------------
// | date: 2016-11-13
// +----------------------------------------------------------------------
// | LogLibraryTest.php: 测试日志
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

use PHPUnit\Framework\TestCase;
use Yangyifan\Library\UtilityLibrary;

class UtilityLibraryTest extends TestCase
{
    //测试
    public function testUrlToHttps()
    {
        $urlArr = [
            'http://www.baidu.com?url=https://www.baidu.com',
            'https://www.baidu.com',
            'baidu.com',
            'zhidao.baidu.com',
            'zhidao.baidu.com/s=1',
            'http://zhidao.baidu.com/s=1',
            'https://zhidao.baidu.com/s=1',
        ];

        foreach ( $urlArr as &$url) {
            $url = UtilityLibrary::mergeUrlProtocol($url, UtilityLibrary::URL_HTTPS);
        }
    }
}