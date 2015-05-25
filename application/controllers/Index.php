<?php
/*=============================================================================
#     FileName: Index.php
#         Desc: yaf 默认控制器
#       Author: wangkongming
#        Email: komiles@163.com
#     HomePage: http://www.wangkongming.cn/
#      Version: 0.0.1
#   LastChange: 2015-05-25 18:24:00
#      History: 2014-12-14
=============================================================================*/

include APP_PATH.'/application/models/Blog.php';
header("Content-type: text/html; charset=utf-8"); 
class IndexController extends Yaf_Controller_Abstract {
    public function init() {
        Yaf_Dispatcher::getInstance()->disableView();
    }
    /**
     * 默认控制器
     */
    public function indexAction() {
        //查询当前使用的所有路由协议  
        $routes = Yaf_Dispatcher::getInstance()->getRouter()->getRoutes();  
        print_r($routes);  
        $site   =   Yaf_Application::app()->getConfig();
        $this->getView()->assign('content','hello world222~!');
        $this->getView()->display('index_1.html');
    }
    
    /**
     * 链接数据库
     * url:/index/index/testDb
     */
    public function testDbAction() {
        $blogModels   =   new BlogModels();
        $result       =   $blogModels   ->getAllBlogs();
        $this->getView()->assign('result'   , $result);
        $this->getView()->display('index/test.html');
        exit;
    }
    
    /**
     * 链接数据库
     */
    public function phpinfoAction() {
        phpinfo();
        exit;
    }
}

