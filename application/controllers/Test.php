<?php
/**
 * 测试文件，用来测试各种配置和文件
 * @author  wangkongming<komiles@163.com>
 * @date    2014-12-20
 */
class TestController extends    Yaf_Controller_Abstract {
    public function initAction() {
        //$this->initView();
        //$this->getView()->name = "value";
    }
    /**
     * 默认控制器
     */
    public function indexAction() {
        $content   =   '这个是testController测试文件';
        $this->getView()->assign('content',$content);
        $this->getView()->display('test/index.html');
        exit;
    }
    /**
     * getModuleNameAction
     * 获取每个模块的值
     * @access public
     * @return void
     */
    public function getModuleNameAction() {
        echo "current Module:" . $this->getRequest()->getModuleName();
        echo "<br/>";
        echo "current Controller:" . $this->getRequest()->getControllerName();
        echo "<br/>";
        echo "current Action:" . $this->getRequest()->getActionName();
        echo "<br/>";
        exit;
    }

    /**
     * requestAction 
     * 获取request请求
     * @access public
     * @return void
     */
    public function requestAction() {
        $request = $this->getRequest();
        echo "<pre/>";
        print_r($request);
        echo "<hr/>";
        $response = $this->getResponse();
        echo "<pre/>";
        print_r($response);
        echo "<hr/>";
        $view = $this->getView();
        echo "<pre/>";
        print_r($view);
        exit;
    }
    /**
     * view
     */
    public function viewAction() {
        //$view = $this->initView();
        /* 此后就可以直接通过获取Yaf_Controller_Abstract::$_view

        来访问当前视图引擎 */
        echo  $this->getView()->getScriptPath();
        //获取当前view的路径
        //echo $this->getViewPath();
        $this->getView()->assign("content", "test setViewPath");
        $this->setViewPath('/data/webroot/testRoot/application/views/test/');
        //$this->getView()->display("index.html");
        echo $this->getView()->render("index.html");
        exit;
        //$this->_view->assign("content", "11111111111111111111");
        //$this->_view->display("test/view.html");
        $this->getView()->assign("content", "233333344444444444444");
        $this->getView()->display("test/view.html");
        exit;
    }

    public  function forwardAction() {
        $this->redirect("/index/index/list/");
    }
    /**
     * redirectAction 
     * 重定向请求到新的路径
     * @access public
     * @return void
     */
    public  function redirectAction() {
        //这两种方式都可以
        $this->getResponse()->setRedirect("http://www.baidu.com");
        $this->redirect("/index/index/list/");
    }
    /**
     * paramsAction 
     * 获取参数
     * @access public
     * @return void
     */
    public function paramsAction() {
        $re = $this->getRequest()->getParams();
        var_dump($re);exit;
    }

    /**
     * routeAction 
     * 路由
     * @access public
     * @return void
     */
    public function routeAction() {
        echo "this is :" . Yaf_Dispatcher::getInstance()->getRouter()->getCurrentRoute();
        exit;
        //获取当前请求类型
        $re = $this->getRequest()->getMethod();
        var_dump($re);
        //获取参数
        $this->getRequest()->setParam("id", 12);
        $id = $this->getRequest()->getParam('id');
        //echo "user id:" . $this->getRequest()->getParam("userid", 5);
        var_dump($id);exit;
    }
    /**
     * cliAction 
     * cli请求
     * @access public
     * @return void
     */
    public function cliAction() {
        //设置响应的body
        $this->getResponse()->setBody("Hello World");
        //在body前加数据
        $this->getResponse()->prependBody("hi,");
        //在body后面加数据
        $this->getResponse()->appendBody("babytree");
        $re = $this->getResponse()->getBody();
        //清除已经设置的响应body
        $this->getResponse()->clearBody();
        var_dump($re);exit;
        //获取当前请求是否是cli请求
        $re = $this->getRequest()->isCli();
        //判断是否是get请求
        $re = $this->getRequest()->isGet();
        var_dump($re);exit;
    }
    /**
     * isModuleAction
     *
     * @access public
     * @return void
     */
    public function isModuleAction() {
        echo 222;
        $routes = Yaf_Dispatcher::getInstance()->isModuleNamer("Index");
        var_dump($routes);
        echo 1111;
    }

}
