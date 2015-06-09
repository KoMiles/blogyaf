<?php
/**
 * ArticleController 
 * 文章控制器
 * @uses BasicController
 * @package 
 * @version $Id$
 * @author wangkongming <komiles@163.com> 
 * @date 2015-06-05 10:40:03
 */
class ArticleController extends BasicController {
    private $m_article;

    private function init(){
        $this->m_article = $this->load('Article');

    }

    public function indexAction(){
        echo 'Article index'; die;
    }

    /**
     * detailAction 
     * 
     * @param mixed $id 
     * @access public
     * @return void
     */
    public function detailAction($id) {
        echo "index article detail action";
        exit;
    }
    public function routeAction() {
        echo "test";
        echo "detail action ";
        echo "route is :" . Yaf_Dispatcher::getInstance()->getRouter()->getCurrentRoute();
    }

}

