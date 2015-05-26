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