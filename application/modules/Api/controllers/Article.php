<?php
/**
 * ArticleController 
 * 文章相关Api
 * @uses Yaf
 * @uses _Controller_Abstract
 * @package 
 * @version $Id$
 * @author wangkongming <komiles@163.com> 
 * @date 2015-09-16 18:59:25
 */
class ArticleController extends Yaf_Controller_Abstract {
    private $m_article;

    private function init(){
        $this->m_article = new ArticleModel();
    }
    /**
     * getListAction 
     * 文章列表
     * @access public
     * @return void
     */
    public function getListAction() {
        $page = $this->getRequest()->getQuery("page") ? $this->getRequest()->getQuery("page") : 1;
        $limit = $this->getRequest()->getQuery("limit") ? $this->getRequest()->getQuery("limit") : 10;

        $total_num = $this->m_article -> getArticleTotal('normal');
        $article_list = $this->m_article->getArticlesList($page, $limit, 'normal');
        $result['list'] = $article_list;
        $pager = array(
            'page' => $page,
            'limit' => $limit,
            'total_num' => $total_num,
        );

        echo Tool_String::jsonView('success', $result, '', $pager);
        exit;
    }
}
