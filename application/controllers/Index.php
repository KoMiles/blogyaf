<?php
/**
 * yaf 默认控制器
 * @author wangkongming<komiles@163.com>
 * @date    2014-12-14
 */

class IndexController extends Yaf_Controller_Abstract {
    /**
     * 默认控制器
     */
    public function indexAction() {
        $this->getView()->assign('content','hello world~!');
    }
}

