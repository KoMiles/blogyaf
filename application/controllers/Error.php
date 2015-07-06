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
         //1. assign to view engine
         //$exception = $this->getRequest()->getParam('exception');
         $this->getView()->assign("exception", $exception);
         /*Yaf has a few different types of errors*/
         switch($exception->getCode()):
         case YAF_ERR_NOTFOUND_MODULE:
         case YAF_ERR_NOTFOUND_CONTROLLER:
         case YAF_ERR_NOTFOUND_ACTION:
         case YAF_ERR_NOTFOUND_VIEW:
         return $this->_pageNotFound();
         default:
         return $this->_unknownError();
         endswitch;
         //5. render by Yaf 
      }
      private function _pageNotFound(){
         $this->getResponse()->setHeader('HTTP/1.0 404 Not Found');
         $this->_view->error = 'Page was not found';
      }
      private function _unknownError(){
         $this->getResponse()->setHeader('HTTP/1.0 500 Internal Server Error');
         $this->_view->error = 'Application Error';
      }
   }
