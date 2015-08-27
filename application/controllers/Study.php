<?php
/**
 * StudyController 
 * 
 * @uses Yaf
 * @uses _Controller_Abstract
 * @package 
 * @version $Id$
 * @author wangkongming <komiles@163.com> 
 * @date 2015-08-27 15:58:40
 */
class StudyController extends Yaf_Controller_Abstract {
    public function initAction() {

    }
    /**
     * 默认控制器
     */
    public function indexAction() {
        echo "此页面已生效！";
        exit;
    }
    public function pdoAction() {
        echo "this is pdo test";
        exit;

    }
    public function ArticleAction() {
        $config = Yaf_Registry::get("config");
        $database = $config ->database;
        $master_ip = $database->master->server;
        $slaves = $database->slaves->toArray();
var_dump($slaves);
//var_dump($database);
        echo "this is article action! ";
        exit;
    }


}
