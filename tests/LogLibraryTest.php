<?php

// +----------------------------------------------------------------------
// | date: 2016-11-13
// +----------------------------------------------------------------------
// | LogLibraryTest.php: 测试日志
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

use PHPUnit\Framework\TestCase;
use Yangyifan\Library\LogLibrary;

class LogLibraryTest extends TestCase
{
    //测试 Debug
    public function testDebug()
    {
        //测试调试日志
        LogLibrary::debug(LogLibrary::ACCESS_LOG, 'access_log 日志');
        LogLibrary::debug(LogLibrary::PAY_LOG, 'pay_log 日志');
        LogLibrary::debug(LogLibrary::ERR_LOG, 'err_log 日志');
        LogLibrary::debug(LogLibrary::DEBUG_LOG, 'debug 日志');
    }

    //测试写入日志
    public function testWriteLog()
    {
        LogLibrary::writeLog('warn', 'warn', '测试日志', ['content' => '测试日志内容']);
        LogLibrary::writeLog('info', 'info', '测试日志', ['content' => '测试日志内容']);
        LogLibrary::writeLog('alert', 'alert', '测试日志', ['content' => '测试日志内容']);
        LogLibrary::writeLog('debug', 'debug', '测试日志', ['content' => '测试日志内容']);
        LogLibrary::writeLog('notice', 'notice', '测试日志', ['content' => '测试日志内容']);
        LogLibrary::writeLog('error', 'error', '测试日志', ['content' => '测试日志内容']);
    }
}