<?php

class BasicController extends Yaf_Controller_Abstract {

    public function get($key, $filter = TRUE){
        if($filter){
            return filterStr($this->getRequest()->get($key));
        }else{
            return $this->getRequest()->get($key);
        }
    }

    /**
     * getPost 
     * post提交数据
     * @param mixed $key 
     * @param mixed $filter 
     * @access public
     * @return void
     */
    public function getPost($key, $filter = TRUE){

        if($filter){
            return filterStr($this->getRequest()->getPost($key));
        }else{
            return $this->getRequest()->getPost($key);
        }
    }

    /**
     * getQuery 
     * get提交数据
     * @param mixed $key 
     * @param mixed $filter 
     * @access public
     * @return void
     */
    public function getQuery($key, $filter = TRUE){
        if($filter){
            return filterStr($this->getRequest()->getQuery($key));
        }else{
            return $this->getRequest()->getQuery($key);
        }
    }

    /**
     * getParam 
     * 路由提交数据
     * @param mixed $key 
     * @param mixed $filter 
     * @access public
     * @return void
     */
    public function getParam($key, $filter = TRUE){
        if($filter){
            return filterStr($this->getRequest()->getParam($key));
        }else{
            return $this->getRequest()->getParam($key);
        }
    }

    public function getSession($key){
        return Yaf_Session::getInstance()->__get($key);
    }

    public function setSession($key, $val){
        return Yaf_Session::getInstance()->__set($key, $val);
    }

    public function unsetSession($key){
        return Yaf_Session::getInstance()->__unset($key);
    }

    // Load model
    public function load($model){
        return Helper::load($model);
    }

}
