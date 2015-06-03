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

    // only display errors under DEV
    public function errorAction($exception){
                echo 404, ":", $exception->getMessage();
        }
    }
}
