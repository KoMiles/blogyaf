<?php
/**
 * ErrorController 
 * 
 * @uses Yaf
 * @uses _Controller_Abstract
 * @package 
 * @version $Id$
 * @author wangkongming <komiles@163.com> 
 */
class ErrorController extends Yaf_Controller_Abstract {

    public function errorAction($exception) {
        $message = $exception->__toString();
        $this->getView()->assign("code", $exception->getCode());
        //$this->getView()->assign("message", $exception->getMessage());
        $this->getView()->assign("message", $message);
        $this->getView()->display('error/error.html');
        exit;
    }
}
