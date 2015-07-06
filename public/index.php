<?php
/*=============================================================================
#     FileName: index.php
#         Desc: yaf入口文件
#       Author: wangkongming
#        Email: komiles@163.com
#     HomePage: http://www.wangkongming.cn/
#      Version: 0.0.1
#   LastChange: 2015-05-25 17:37:58
#      History: 2014-12-14
=============================================================================*/

header('content-Type:text/html;charset=utf-8;');
define("APP_PATH",  realpath(dirname(__FILE__) . '/../')); /* 指向public的上一级 */
require APP_PATH.'/application/const.php';

$app  = new Yaf_Application(APP_PATH . "/conf/application.ini");
$app->bootstrap()->run();
