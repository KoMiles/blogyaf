<?php
/**
 * ArticleController 
 * 文章相关的页面
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
     * 文章列表页面
     * @access public
     * @return void
     */
    public function indexAction(){
        $pageSize = 10;
        $page = $this->getQuery("page") ? $this->getQuery("page") : 1;
        $article_list = $this->m_article->getArticlesList($page, $pageSize, 'normal');
        foreach ($article_list as $key => $row) {
            $article_list[$key]['date'] = date('Y-m-d H:i:s',$row['create_ts']);
        }
        $total_num = $this->m_article -> getArticlesCount('normal');

        $page_string = generatePageLink($page, $pageSize, $total_num, "/article");

        $title = "文章列表";
        $this->getView()->assign('page_string', $page_string);
        $this->getView()->assign('title', $title);
        $this->getView()->assign('data_list', $article_list);
        $this->getView()->display('./index.html');
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

