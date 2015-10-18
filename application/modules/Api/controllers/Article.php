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
        $article_list = $this->m_article->getArticlesList($page, $limit, 'normal');
        $total_num = $this->m_article -> getArticleTotal('normal');
        $result['list'] = $article_list;
        $result['page'] = $total_num;

        echo Tool_String::jsonView('success',$result);
        exit;
    }
    public function indexAction() {
        $pageSize = 10;
        $page = $this->getRequest()->getQuery("page") ? $this->getRequest()->getQuery("page") : 1;
        //$page = $this->getRequest()->getParam("page") ? $this->getRequest()->getParam("page") : 1;
        $article_list = $this->m_article->getArticlesList($page, $pageSize, 'normal');
        foreach ($article_list as $key => $row) {
            $article_list[$key]['date'] = date('Y-m-d H:i:s',$row['create_ts']);
            $article_list[$key]['statusCn'] = $row['status'] == 'normal' ? '正常' : '已删除';
        }
        $total_num = $this->m_article -> getArticleTotal('normal');

        $pageObj = new Tool_Pagination();
        $page_html = $pageObj->markPhpPager('?page={page}',$page,$pageSize,$total_num);
        //$page_html = $pageObj->markPhpPager('{page}',$page,$pageSize,$total_num);

        $title = "文章列表";
        $this->getView()->assign('page_string', $page_html);
        $this->getView()->assign('title', $title);
        $this->getView()->assign('article_list', $article_list);
        $this->getView()->display('index.html');
        exit;
    }
}
