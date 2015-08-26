<?php
/*=============================================================================
#     FileName: Mobile.php
#         Desc:  
#       Author: wangkongming
#        Email: komiles@163.com
#     HomePage: http://www.wangkongming.cn/
#      Version: 0.0.1
#   LastChange: 2015-08-26 10:03:22
#      History:
=============================================================================*/

class MobileController extends Yaf_Controller_Abstract {
    public function init() {
        Yaf_Dispatcher::getInstance()->disableView();
    }
    /**
     * 默认控制器
     */
    public function detailAction() {
        $site   =   Yaf_Application::app()->getConfig();
        echo "this is mobile controller and detail action";
        exit;
    }
    public function indexAction() {
        echo "this is mobile controller and index action";
        exit;
    }
}

