<?php

// +----------------------------------------------------------------------
// | date: 2016-11-13
// +----------------------------------------------------------------------
// | LogLibrary.php: 日志库
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------


namespace Yangyifan\Library;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\BufferHandler;

class LogLibrary
{
    const PAY_LOG       = 'pay_log';    // 支付日志
    const ERR_LOG       = 'err_log';    // 错误日志
    const DEBUG_LOG     = 'debug_log';  // 调试日志
    const ACCESS_LOG    = 'access_log'; // 访问日志
    const UPLOAD_LOG    = 'upload_log'; // 上传日志
    const SMS_LOG       = 'sms_log';    // 短信日志

    /**
     * 获得文件路径
     *
     * @return string
     */
    public static function getLogPath($file)
    {
        return storage_path("/logs/{$file}.log");
    }

    /**
     * 记录日志
     *
     * @param $type
     * @param $logs
     * @param bool $showTime
     */
    public static function debug($type, $logs, $showTime = true)
    {
        $filename = static::getLogPath($type.'_'.date('Y-m-d'));
        @file_put_contents($filename, ($showTime ? '['.date('Y-m-d H:i:s').'] ' : '').$logs."\n", FILE_APPEND);
    }

    /**
     * 写入日志
     *
     * @param string $logName   日志文件名
     * @param string $level     日志等级
     * @param string $key       日志说明
     * @param string $data      日志数据
     */
    public static function writeLog($logName, $level, $key, $data)
    {
        $levelArray = array(
            'warn'		=>	Logger::WARNING,
            'info'		=>	Logger::INFO,
            'alert'		=>	Logger::ALERT,
            'debug'		=>	Logger::DEBUG,
            'notice'	=>	Logger::NOTICE,
            'error'		=>	Logger::ERROR,
        );
        $logLevel = $levelArray[$level];
        $logger = new Logger($logName);
        $stream = new StreamHandler(static::getLogPath($logName), $logLevel);

        $logger->pushHandler(new BufferHandler($stream, 10000, $logLevel, true, true));

        if ($level == 'warn') {
            $logger->warn($key, $data);
        } else if ($level == 'info') {
            $logger->info($key, $data);
        } else if ($level == 'alert') {
            $logger->alert($key, $data);
        } else if ($level == 'debug') {
            $logger->debug($key, $data);
        } else if ($level == 'notice') {
            $logger->notice($key, $data);
        } else if ($level == 'error') {
            $logger->error($key, $data);
        }
    }
}