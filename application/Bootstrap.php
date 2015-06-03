<?php
/*=============================================================================
#     FileName: Bootstrap.php
#         Desc: 引导程序,做很多全局自定义的工作,这个类也必须继承自Yaf_Bootstrap_Abstract
                所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
                这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
                调用的次序, 和申明的次序相同
#       Author: wangkongming
#        Email: komiles@163.com
#     HomePage: http://www.wangkongming.cn/
#      Version: 0.0.1
#   LastChange: 2015-05-25 17:34:34
#      History: 2015-01-13  16:47:51
=============================================================================*/


class Bootstrap extends Yaf_Bootstrap_Abstract {

    public function _initConfig() {
        $config = Yaf_Application::app()->getConfig();
        Yaf_Registry::set("config", $config);
    }

    // Load libaray, MySQL model, function
    public function _initCore() {
        define('TB_PREFIX',    '');
        //define('APP_NAME'   ,  'YOF-DEMO');
        define('LIB_PATH',     APP_PATH.'/application/library');
        define('MODEL_PATH',   APP_PATH.'/application/models');
        define('FUNC_PATH',    APP_PATH.'/application/function');
        define('ADMIN_PATH',   APP_PATH.'/application/modules/Admin');

        // CSS, JS, IMG PATH
        define('CSS_PATH', '/css');
        define('JS_PATH',  '/js');
        define('IMG_PATH',  '/img');

        // Admin CSS, JS PATH
        define('ADMIN_CSS_PATH', '/admin/css');
        define('ADMIN_JS_PATH',  '/admin/js');

        Yaf_Loader::import('M_Model.pdo.php');
        Yaf_Loader::import('Helper.class.php');

        //Helper::import('Basic');
        //Helper::import('Network');
        Yaf_Loader::import('C_Basic.php');
    }


    /**
     * 注册一个插件
     * 插件的目录是在application_directory/plugins
     */
    public function _initPlugin(Yaf_Dispatcher $dispatcher) {
        //$user = new UserPlugin();
        //$dispatcher->registerPlugin($user);
    }

    /**
     * 添加配置中的路由
     */
    public function _initRoute(Yaf_Dispatcher $dispatcher) {
        $router = Yaf_Dispatcher::getInstance()->getRouter();
        $router->addConfig(Yaf_Registry::get("config")->routes);
    }

    /**
     * 自定义视图引擎
     */
    public function _initSmarty(Yaf_Dispatcher $dispatcher) {
        //$smarty = new Smarty_Adapter(null, Yaf_Registry::get("config")->get("smarty"));
        //Yaf_Dispatcher::getInstance()->setView($smarty);
    }
}
