<?php
/**
 * ArticleController 
 *
 * @uses BasicController
 * @package
 * @version $Id
 * @author wangkongming <wangkongming@babytree-inc.com> 
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
     * /index.php?m=index&c=article&a=detail
     * @access public
     @return void
     */
    public function detailAction() {
        echo "index article detail action";
        exit;
    }
    public function routeAction() {
        echo "test";
        echo "route is :" . Yaf_Dispatcher::getInstance()->getRouter()->getCurrentRoute();
    }

}

