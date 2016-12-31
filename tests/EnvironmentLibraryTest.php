<?php

// +----------------------------------------------------------------------
// | date: 2016-11-13
// +----------------------------------------------------------------------
// | LogLibraryTest.php: 测试日志
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

use PHPUnit\Framework\TestCase;
use Yangyifan\Library\EnvironmentLibrary;

class EnvironmentLibraryTest extends TestCase
{
    // 根据对应的参数，获得当前的环境
    public function testGetEvnironment()
    {
//        var_dump(
//            EnvironmentLibrary::ENV_LOCAL |
//            EnvironmentLibrary::ENV_DEV |
//            EnvironmentLibrary::ENV_TEST|
//            EnvironmentLibrary::ENV_PRODUCT_TEST |
//            EnvironmentLibrary::ENV_PRODUCT
//        );die;
//
//
//        $envName = EnvironmentLibrary::getEvnironment(1 ^ 2);
//        echo $envName;
    }
}