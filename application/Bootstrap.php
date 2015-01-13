<?php

/**
 * @Description     BootStrap.php 文件
 * @author wangkongming <komiles@163.com> 
 * @date 2015-1-13  16:47:51
 * @copyright Copyright (C) 2002-2014 孔夫子旧书网
 */

class Bootstrap extends Yaf_Bootstrap_Abstract
{
    public function _initBootstrap(Yaf_Dispatcher $dispatcher)
    {
        //Yaf_Registry::set('g_config', Yaf_Application::app()->getConfig());
    }
    /**
     * 注册一个插件
     * 插件的目录是在application_directory/plugins
     */
    public function _initPlugin(Yaf_Dispatcher $dispatcher) {
//        $user = new UserPlugin();
//        $dispatcher->registerPlugin($user);
    }

    /**
     * 添加配置中的路由
     */
    public function _initRoute(Yaf_Dispatcher $dispatcher) {
//        $router = Yaf_Dispatcher::getInstance()->getRouter();
//        $router->addConfig(Yaf_Registry::get("config")->routes);
//        /**
//         * 添加一个路由
//         */
//        $route  = new Yaf_Route_Rewrite(
//                "/product/list/:id/",
//                array(
//                        "controller" => "product",
//                        "action"         => "info",
//                )
//        );
//
//        $router->addRoute('dummy', $route);
    }

    /**
     * 自定义视图引擎
     */
    public function _initSmarty(Yaf_Dispatcher $dispatcher) {
//            $smarty = new Smarty_Adapter(null, Yaf_Registry::get("config")->get("smarty"));
//            Yaf_Dispatcher::getInstance()->setView($smarty);
    }
}