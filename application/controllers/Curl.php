<?php
/**
 * CurlController 
 * Curl测试文件
 * @uses Yaf
 * @uses _Controller_Abstract
 * @package 
 * @version $Id$
 * @author wangkongming <komiles@163.com> 
 * @date 2015-09-21 19:13:30
 */
class CurlController extends    Yaf_Controller_Abstract {
    public function initAction() {
        //$this->initView();
        //$this->getView()->name = "value";
    }
    /**
     * 默认控制器
     */
    public function indexAction() {
        $content   =   '这个是curlController测试文件';
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
    public function testAction() {
        $curl = new Tool_Curl(false);
        $url = "http://www.babytree.com/api/mobile_community_index/get_competitor_list";
        $data = $curl->get($url);
        echo $data;
        exit;
    }
}
