<?php
/**
 * ArticleController 
 * 
 * @uses BasicController
 * @package 
 * @version $Id$
 * @author wangkongming <komiles@163.com> 
 * @date 2015-06-09 18:48:32
 */
class ArticleController extends BasicController {
    private $m_article;

    private function init(){
        $this->m_article = $this->load('Article');

    }

    /**
     * indexAction 
     * 
     * @access public
     * @return void
     */
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

