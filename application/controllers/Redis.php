<?php
/**
 * RedisController 
 * redis测试
 * URL:/redis/index
 * @uses Yaf
 * @uses _Controller_Abstract
 * @package 
 * @version $Id$
 * @author wangkongming <komiles@163.com> 
 * @date 2016-02-14 14:33:33
 * @from http://blog.51yip.com/cache/1439.html
 */

class RedisController extends Yaf_Controller_Abstract{
    private $redis = null;
    private $title = "";
    private function init(){
        if($this -> redis == null) {
            $this -> redis = new Redis();
        }
        $this -> redis-> connect('127.0.0.1',6379);
        $this->title = "测试Redis";
    }

    public function indexAction(){
        $this->getView()->assign("title",$this->title);
        $this->getView()->display('./redis/index.html');
        exit;
    }
    
    /**
     * connectAction 
     * 链接redis实例
     * @access public
     * @return void
     */
    public function connectAction() {
        $result = $this -> redis-> connect('127.0.0.1',6379);
        if($result) {
            $message = "redis链接成功";
        } else {
            $message = "redis链接失败！";
        }

        $this->getView()->assign("title",$this->title);
        $this->getView()->assign("message",$message);
        $this->getView()->display('./redis/message.html');
        exit;
    }

    /**
     * setAction 
     * 设置
     * @access public
     * @return void
     */
    public function setAction() {
        $result = $this -> redis-> set('test','111111111111111111111');
        if($result) {
            $message = "redis的设置key成功";
        } else {
            $message = "set失败！";
        }

        $this->getView()->assign("title",$this->title);
        $this->getView()->assign("message",$message);
        $this->getView()->display('./redis/message.html');
        exit;
    }

    /**
     * getAction 
     * 获得key值
     * @access public
     * @return void
     */
    public function getAction() {
        $result = $this -> redis-> get('test');
        $message = "键为test，值为{$result}";
        $result = $this -> redis-> set('test','22222222222222');

        $this->getView()->assign("title",$this->title);
        $this->getView()->assign("message",$message);
        $this->getView()->display('./redis/message.html');
        exit;
    }

    /**
     * deleteAction 
     * 删除key
     * @access public
     * @return void
     */
    public function deleteAction() {
        $result = $this -> redis-> get('test');
        echo $message = "键为test，值为{$result}";
        $result = $this -> redis-> delete('test');
        $message = "删除状态为{$result}";

        $this->getView()->assign("title",$this->title);
        $this->getView()->assign("message",$message);
        $this->getView()->display('./redis/message.html');
        exit;
    }

    /**
     * setnxAction 
     * 如果在数据库中不存在该键，设置关键值参数
     * 如果不存在，返回true,如果key已经存在，返回false
     * @access public
     * @return void
     */
    public function setnxAction() {
        $result = $this -> redis-> setnx('test1_komiles',"11111111111");
        var_dump($result);
        $message = "键值不存在，设置关键值参数，状态为{$result}";

        $this->getView()->assign("title",$this->title);
        $this->getView()->assign("message",$message);
        $this->getView()->display('./redis/message.html');
        exit;
    }

    /**
     * existsAction 
     * 验证指定的键是否存在,Bool 成功返回：TRUE;失败返回：FALSE
     * @access public
     * @return void
     */
    public function existsAction() {
        $result = $this -> redis-> exists('test1_komiles');
        var_dump($result);
        $message = "键为test1_komiles，状态为{$result}";

        $this->getView()->assign("title",$this->title);
        $this->getView()->assign("message",$message);
        $this->getView()->display('./redis/message.html');
        exit;
    }

    /**
     * incrAction 
     * 键对应的值自增
     * @access public
     * @return void
     */
    public function incrAction() {
        $key = "test3_komiles";
        $key_exists = $this -> redis -> exists($key);
        if($key_exists) {
            $num = $this -> redis -> incr($key);
        } else {
            $this -> redis -> set($key,1);
            $num = $this -> redis -> get($key);
        }
        $message = "键为{$key},对应的值为{$num}";
        $this->getView()->assign("title",$this->title);
        $this->getView()->assign("message",$message);
        $this->getView()->display('./redis/message.html');
        exit;
    }

    /**
     * decrAction 
     * 减少键对应的值
     * @access public
     * @return void
     */
    public function decrAction() {
        $key = "test3_komiles";
        $key_exists = $this -> redis -> exists($key);
        if($key_exists) {
            if($this -> redis -> get($key)) {
                $num = $this -> redis -> decr($key);
            } else {
                $num = 0;
            }
        } else {
            $num  = 0;
        }
        $message = "键为{$key},对应的值为{$num}";
        $this->getView()->assign("title",$this->title);
        $this->getView()->assign("message",$message);
        $this->getView()->display('./redis/message.html');
        exit;
    }
}

