<?php

/**
 * yaf入口文件
 * @author  wangkongming<komiles@163.com>
 * @date    2014-12-14
 */
define("APP_PATH",  realpath(dirname(__FILE__) . '/../')); /* 指向public的上一级 */
$app  = new Yaf_Application(APP_PATH . "/conf/application.ini");
$app->bootstrap()->run();