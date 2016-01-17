<?php

class InfoController extends Yaf_Controller_Abstract {
    public function init() {
        Yaf_Dispatcher::getInstance()->disableView();
    }
    /**
     * 默认控制器
     */
    public function indexAction() {
        echo phpinfo();
        exit;
    }

}
