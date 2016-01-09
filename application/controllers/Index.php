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

class IndexController extends Yaf\Controller_Abstract {
    public function init() {
        Yaf\Dispatcher::getInstance()->disableView();
    }
    /**
     * 默认控制器
     */
    public function indexAction() {
        $site   =   Yaf\Application::app()->getConfig();
        $re = $site->application->ext;
        $this->getView()->assign('content','welcome，The yaf is works！');
        $this->getView()->display('./index/index.html');
        exit;
        //查询当前使用的所有路由协议  
        //$routes = Yaf\Dispatcher::getInstance()->getRouter()->getRoutes();  
        //print_r($routes);  
        //echo "<hr/>";
        $re = $this->getModuleName();
        $re = $this->getRequest()->getModuleName();
        $re = $this->getRequest()->getActionName();
        var_dump($re);
        exit;
        $site   =   Yaf\Application::app()->getConfig();
        $this->getView()->assign('content','hello world222~!');
        $this->getView()->display('index_1.html');
    }

    public function listAction() {
        $re = $this->getRequest()->getActionName();
        var_dump($re);
        echo "index list action";
        exit;
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

    public function detailAction() {
        echo "this is index detail !";
        exit;
    }
    /**
     * 链接数据库
     */
    public function phpinfoAction() {
        phpinfo();
        exit;
    }
    public function viewAction() {
        $str = YAF_VERSION;
        $str = YAF_ENVIRON;
        $str = YAF_ERR_STARTUP_FAILED;
        $str = YAF_ERR_ROUTE_FAILED;
        $str = YAF_ERR_NOTFOUND_MODULE;
        echo "<pre>";
        $str = get_defined_constants();
        var_dump($str);exit;

    }
    public function testAction() {
        echo "this is index module and index controller and test action";
        exit;

    }
}

