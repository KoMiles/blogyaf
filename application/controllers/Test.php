<?php
/**
 * 测试文件，用来测试各种配置和文件
 * @author  wangkongming<komiles@163.com>
 * @date    2014-12-20
 */
include APP_PATH.'/application/models/BlogPdo.php';
class TestController extends    Yaf_Controller_Abstract
{
    
//    public function init() {
//        Yaf_Dispatcher::getInstance()->disableView();
//    }
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
     * pdo
     */
    public function pdoAction() {
        $blogModels   =   new BlogPdoModels();
        $result       =   $blogModels   ->getOneBlogs();
        $this->getView()->assign('result'   , $result);
        $this->getView()->display('test/test.html');
        exit;
    }
}