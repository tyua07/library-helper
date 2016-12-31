<?php

// +----------------------------------------------------------------------
// | date: 2016-11-13
// +----------------------------------------------------------------------
// | UtilityLibrary.php: 工具库
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace Yangyifan\Library;

use Illuminate\Support\Collection;

class UtilityLibrary
{
    /**
     *  url 相关常量
     */
    const URL_HTTP  = 'http';   // http 协议
    const URL_HTTPS = 'https';  // https 协议

    /**
     * 递归 ksort
     *
     * @param array $data
     * @return array
     */
    public static function ksort($data)
    {
        if (static::isArray($data) ) {
            foreach ( $data as &$v ) {
                if (is_array($v)) {
                    $v = static::ksort($v);
                }
            }
        }

        ksort($data);

        return $data;
    }

    /**
     * 对象转换成数组
     *
     * @param $object
     * @return mixed
     */
    public static function objToArray($object)
    {
        return json_decode( json_encode( $object),true);
    }

    /**
     * 计算运行时间
     *
     * @param int $mode
     * @return mixed
     */
    public static function runtime($mode = 0)
    {
        static $t;
        if(!$mode) {
            $t = microtime();
        } else {
            $t1 = microtime();
            list($m0,$s0) = explode(" ",$t);
            list($m1,$s1) = explode(" ",$t1);
            return ($s1+$m1-$s0-$m0) * 1000;
        }
    }

    /**
     * 获得当前路由信息
     *
     * @return array
     */
    public static function getRouteInfo()
    {
        $action 				= \Route::current()->getActionName();
        list($class, $method) 	= explode('@', $action);
        return ['controller_name' => ltrim($class, '\\'), 'method_name' => $method];
    }

    /**
     * 判断是否是数组
     *
     * @param $array
     * @return bool
     */
    public static function isArray($array)
    {
        if ( ( $array instanceof Collection && $array->isEmpty() == false ) || ( is_array($array) && count($array) > 0 ) ) {
            return true;
        }
        return false;
    }

    /**
     * 组合 url 协议
     *
     * @param $url
     * @param string $protocol
     * @return mixed
     */
    public static function mergeUrlProtocol($url, $protocol = null)
    {
        $protocol   = is_null($protocol) ? static::getProtocol() : $protocol; // 协议类型
        $pattern    = '/^([a-zA-z]+)(:\/\/[^\s]*)/';                           // 正则表达式

        // 执行正则匹配
        preg_match($pattern, $url, $match);

        if ( static::isArray($match) ) {
            if ( isset($match[1]) ) {
                return preg_replace($pattern, $protocol . '$2', $url);
            }
        }

        return $protocol . '://' . $url;
    }

    /**
     * 协议类型
     *
     * @return string
     */
    protected static function getProtocol()
    {
        return env('IS_SECURE', false) ? UtilityLibrary::URL_HTTPS : UtilityLibrary::URL_HTTP;
    }

    /**
     * 随机生成中奖事件
     *
     * @description 1:表示中奖；0：表示没有中奖
     * @param string $probability设置中奖的概率 1表示100%，0.01表示1%，0.001为千分之一
     * @return int
     */
    public static function getLucky($probability)
    {
        // 如果中奖率是 1 ，则表示中奖率是百分之百
        if ( 1 == $probability ) {
            return true;
        }

        if ( is_float($probability) && $probability >= 0 && $probability <= 1 ) {

            $denominator    = 1;
            $flo            = 1;

            for (; $flo > 0;) {
                $str = explode('.',$probability);

                if ( count($str)>1 ) {
                    $flo = end($str);
                } else {
                    break;
                }

                $probability    *= 10;
                $denominator    *=10;
            }
            $rand = mt_rand(1,$denominator);

            if ( $rand <= $probability ) {
                return 1;
            }

            return 0;
        }

        return 0;
    }

    /**
     * 版本号判断
     *
     * 判断v1版本号是否大于v2,若v1大于v2,返回true，否则返回 false
     * @param string $v1
     * @param string $v2
     * @return bool
     */
    public static function compareVersion($v1, $v2)
    {
        if(empty($v1)){
            return 0;
        }

        $l1  = explode('.',$v1);
        $l2  = explode('.',$v2);
        $len = count($l1) > count($l2) ? count($l1): count($l2);

        for ($i = 0; $i < $len; $i++){
            $n1 = isset($l1[$i])?$l1[$i]:0;
            $n2 = isset($l2[$i])?$l2[$i]:0;
            if ($n1 > $n2){
                return true;//需要更新
            }else if ($n1 < $n2){
                return false;//不需要更新
            }
        }
        return false;
    }

    /**
     * 判断是否是手机号码
     *
     * @param $mobile
     * @param null $pattern
     * @return bool
     */
    public static function isMobile($mobile, $pattern  = null)
    {
        // 手机号码长度
        $mobileLength = 11;

        if ( !empty($mobile) && is_numeric($mobile) && strlen($mobile) == $mobileLength ) {
            preg_match($pattern ? : '/^1[34578]{1}\d{9}$/', $mobile, $matches);

            if ( static::isArray($matches) && !empty($matches[0]) && strlen($matches[0]) == $mobileLength ) {
                return true;
            }
        }

        return false;
    }
}