<?php

/**
 * TestredisController 
 * /testredis/
 * @uses Yaf
 * @uses _Controller_Abstract
 * @package 
 * @version $Id$
 * @author wangkongming <komiles@163.com> 
 * @date 2016-03-08 21:00:21
 */
class TestredisController extends Yaf_Controller_Abstract{
    private $redis = null;
    private $title = "";
    private function init(){
        if($this -> redis == null) {
            $this -> redis = new Db_Redis('127.0.0.1','6379');
        }
        $this->title = "Redis测试";
    }

    public function indexAction(){
        $url_list = array(
            array(
                "name" => "Redis系统性介绍",
                "url" => "http://blog.nosqlfan.com/html/3139.html",
            ),
        );
        $this->getView()->assign("url_list",$url_list);
        $this->getView()->assign("title",$this->title);
        $this->getView()->display('./redis/index.html');
        exit;
    }
    
    public function addAction() {
        $this->title = "添加一条数据";
        $this->getView()->assign("title",$this->title);
        $this->getView()->display('./testredis/add.html');
        exit;

    }

    public function add_optAction() {
        $username = $this->getRequest()->getPost('username');
        if($username) {
            $res = $this->redis->set('username',$username);
            if($res) {
                echo "设置redis成功，用户名为:{$username}";
            } else {
                echo "设置失败";
            }
        }
        exit;
    }

    public function get_usernameAction() {
        $k = $this ->getRequest()->getQuery('k');
        $res = $this->redis->get($k);
        echo "用户名为:{$res}";
        exit;




    }
}
