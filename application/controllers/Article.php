<?php
/**
 * ArticleController 
 * 文章相关的页面
 * URL:/index/article/index/
 * @uses BasicController
 * @package 
 * @version $Id$
 * @author wangkongming <komiles@163.com> 
 * @date 2015-06-09 18:48:32
 */
class ArticleController extends Yaf_Controller_Abstract{
    private $m_article;

    private function init(){
        $this->m_article = new ArticleModel();
    }

    /**
     * indexAction
     * 文章列表页面
     * @access public
     * @return void
     */
    public function indexAction(){
        $pageSize = 10;
        $page = $this->getRequest()->getQuery("page") ? $this->getRequest()->getQuery("page") : 1;
        //$page = $this->getRequest()->getParam("page") ? $this->getRequest()->getParam("page") : 1;
        $article_list = $this->m_article->getArticlesList($page, $pageSize, 'normal');
        foreach ($article_list as $key => $row) {
            $article_list[$key]['date'] = date('Y-m-d H:i:s',$row['create_ts']);
        }
        $total_num = $this->m_article -> getArticleTotal('normal');

        $pageObj = new Tool_Pagination();
        $page_html = $pageObj->markPhpPager('?page={page}',$page,$pageSize,$total_num);

        $title = "文章列表";
        $this->getView()->assign('page_string', $page_html);
        $this->getView()->assign('title', $title);
        $this->getView()->assign('data_list', $article_list);
        $this->getView()->display('./article/index.html');
        exit;
    }

    /**
     * detailAction 
     * 文章详情页面
     * URL:/article/detail/id/44/
     * @param mixed $id 
     * @access public
     * @return void
     */
    public function detailAction() {
        $id = $this->getRequest()->getParam("id") ? $this->getRequest()->getParam("id") : 1;
        $article_info = $this -> m_article -> getArticleInfo($id);
        $error_message = "";
        if($article_info) {
            $title = "文章详情";
            $article_info['date'] = date('Y-m-d H:i:s',$article_info['update_ts']);
            $this->getView()->assign('title', $title);
            $this->getView()->assign('data_info', $article_info);
        } else {
            $error_message = "文章不存在！";
        }
        $this->getView()->assign('error_msg', $error_message);
        $this->getView()->display('./article/detail.html');
        exit;
    }

}

