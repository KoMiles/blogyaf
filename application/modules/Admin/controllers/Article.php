<?php

/**
 * ArticleController 
 * 
 * @uses BasicController
 * @package 
 * @version $Id$
 * @author wangkongming <komiles@163.com> 
 * @date 2015-06-09 10:23:41
 */
class ArticleController extends BasicController {

    private $m_article;

    private function init(){
        //Yaf_Registry::get('adminPlugin')->checkLogin();

        $this->m_article = $this->load('Article');
        $this->homeUrl = '/admin/article';
    }

    /**
     * indexAction
     * 文章管理首页
     * @access public
     * @return void
     */
    public function indexAction(){
        $article_list = $this->m_article->getArticlesList();
        foreach ($article_list as $key => $row) {
            $article_list[$key]['date'] = date('Y-m-d H:i:s',$row['create_ts']);
            $article_list[$key]['statusCn'] = $row['status'] == 'normal' ? '正常' : '已删除';
        }
        $this->getView()->assign('article_list', $article_list);
        $this->getView()->display('index.html');
    }

    /**
     * addAction 
     * 添加文章
     * @access public
     * @return void
     */
    public function addAction() {
        $this->getView()->display('add.html');
    }

    /**
     * modifyAction 
     * 修改文章
     * @access public
     * @return void
     */
    public function modifyAction() {
        //post方式获取参数
        $title = $this->getPost('title') ;
        $author = $this->getPost('author') ;
        $content = $this->getPost('content') ;
var_dump($content);exit;

        $result = $this->m_article->addArticle($title, $author, $content);
        var_dump($result);
    }
}
