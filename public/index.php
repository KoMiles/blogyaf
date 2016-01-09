<?php
/*=============================================================================
#     FileName: index.php
#         Desc: yaf入口文件
#       Author: wangkongming
#        Email: komiles@163.com
#     HomePage: http://www.wangkongming.cn/
#      Version: 0.0.1
#   LastChange: 2015-08-25 17:06:12
#      History: 2014-12-14
=============================================================================*/
header('content-Type:text/html;charset=utf-8;');
define("APP_PATH",  realpath(dirname(__FILE__) . '/../')); /* 指向public的上一级 */
$app  = new Yaf\Application(APP_PATH . "/conf/application.ini");
$app->bootstrap()->run();
