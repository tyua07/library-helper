<?php

// +----------------------------------------------------------------------
// | date: 2016-11-13
// +----------------------------------------------------------------------
// | EnvironmentLibrary.php: 开发环境库
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace Yangyifan\Library;

class EnvironmentLibrary
{
    const ENV_LOCAL             = 2;    // 本地环境
    const ENV_DEV               = 4;    // 内网环境
    const ENV_TEST              = 8;    // 测试环境
    const ENV_PRODUCT_TEST      = 16;   // 生成测试环境
    const ENV_PRODUCT           = 32;   // 生成环境
    const ENV_ALL               = 64;   // 全部环境

    /**
     * 得到开发环境状态描述
     *
     * @return array
     */
    protected static function environmentName()
    {
        return [
            self::ENV_LOCAL					=>	'local',
            self::ENV_DEV					=>	'develop',
            self::ENV_TEST					=>	'test',
            self::ENV_PRODUCT_TEST			=>	'product_test',
            self::ENV_PRODUCT				=>	'product',
            self::ENV_ALL				    =>	'all',
        ];
    }

    /**
     * 根据对应的参数，获得当前的环境
     *
     * @param $env
     * @return string
     */
    public static function getEvnironment($env)
    {
        // 获得全部环境描述
        $allEnv = static::environmentName();

        if ( $allEnv && array_key_exists($env, $allEnv)) {
            return $allEnv[$env];
        }

        // 否则返回第一个
        return array_pop($allEnv);
    }


}