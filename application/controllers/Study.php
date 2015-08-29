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
        $dbh = new PDO('mysql:host=localhost;dbname=komo', 'root', '123456');
        //$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
        //$dbh->exec('set names utf8'); 
        /*查询*/
        $sql = "SELECT * FROM `Article` limit 1";
        $stmt = $dbh->query($sql);  
        $result = $stmt ->fetch(PDO::FETCH_ASSOC);
        var_dump($result);exit;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){     
            print_r($row);  
        }  
        exit;
        print_r( $stmt->fetchAll(PDO::FETCH_ASSOC)); 

        echo "this is pdo test";
        exit;

    }
    public function ArticleAction() {
        $article_models = new ArticleModel();
        $result = $article_models->getArticle();
        echo "<pre>";
        var_dump($result);exit;
        echo "this is article action! ";
        exit;
    }

    public function ArticleBySqlAction() {
        $article_models = new ArticleModel();
        $result = $article_models->getArticleBysql();
        echo "<pre>";
        var_dump($result);exit;
        echo "this is article action! ";
        exit;
    }

    public function fAction() {
        $rand_str = Function_String::getRandom(6,1);
        var_dump($rand_str);
        echo "this is function test";
        exit;
    }
}
