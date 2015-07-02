<?php

/**
 * ArticleController
 * 文章管理
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
        Helper::import('Basic');
        $this->homeUrl = '/admin/article';
    }

    /**
     * indexAction
     * 文章管理首页
     * @access public
     * @return void
     */
<<<<<<< HEAD
    public function indexAction(){
        $pageSize = 10;
        $page = $this->getQuery("page") ? $this->getQuery("page") : 1;
        $article_list = $this->m_article->getArticlesList($page, $pageSize);
=======
    public function indexAction() {
        //$this->forward("Admin","Article","list");
        //$this->forward("list");
        echo "this is admin article index";
        exit;
    }

    /**
     * listAction 
     * 
     * @access public
     * @return void
     */
    public function listAction(){
        $article_list = $this->m_article->getArticlesList();
>>>>>>> ccd86f27c8bc6d5fee623f785dfaec59dea54de4
        foreach ($article_list as $key => $row) {
            $article_list[$key]['date'] = date('Y-m-d H:i:s',$row['create_ts']);
            $article_list[$key]['statusCn'] = $row['status'] == 'normal' ? '正常' : '已删除';
        }
        //$total_num = $this->m_article -> getArticlesCount();
        //$page_obj = new Pagination('',5);
//var_dump($page_obj);
        //$re = $page_obj -> render($page,$pageSize,$total_num);
//var_dump($re);exit;

        $page_string = generatePageLink($page, $pageSize, "/admin/article/index", $total_num);

        $this->getView()->assign('page_string', $page_string);
        $this->getView()->assign('article_list', $article_list);
        $this->getView()->display('index.html');
    }
    /**
     * modifyAction 
     * 修改文章
     * @access public
     * @return void
     */
    public function modifyAction() {
        //post方式获取参数
        $id = $this->getPost('id') ;
        $type = $this->getPost('type') ;
        $title = $this->getPost('title') ;
        $author = $this->getPost('author') ;
        $content = $this->getPost('content') ;
        if($type == 'add') {
            //添加文章
            $result = $this->m_article->addArticle($title, $author, $content);
        } else if($type == 'edit') {
            $id = $this->getPost('id') ;
            //编辑文章
            $result = $this->m_article->updateArticle($id,$title, $author, $content);
        }
<<<<<<< HEAD
        if($result) {
            javascriptRedirect('操作成功','/admin/article/index');
        } else {
            javascriptRedirect('操作失败','/admin/article/index');
        }
=======
        if($result > 0 ) {
            gotoURL('操作成功','/admin/article/list/');
            exit;
        }
        exit;
>>>>>>> ccd86f27c8bc6d5fee623f785dfaec59dea54de4
    }

    /**
     * viewAction 
     * 显示文章
     * @access public
     * @return void
     */
    public function viewAction() {
        //获取参数
        $op = $this  ->getRequest() ->  getParam('op');
       // $id = $this -> getRequest() ->  getParam('id');
        $id = $this  ->  getParam('id');
        switch($op) {
            case  'add':
                $view = 'add';
                break;
            case  'edit':
                $view = 'edit';
                break;
            case  'delete':
                $view = '';
                break;
            default:
                $view = 'index';
                break;

        }
        if(!empty($view)) {
            $article_info = $this ->m_article ->getArticleInfo($id);
            $this->getView()->assign('article_info',$article_info);
            $this->getView()->display($view.'.html');
            exit;
        } else {
            //执行删除操作
            $result = $this->m_article->deleteArticle($id);
<<<<<<< HEAD
            if($result) {
                javascriptRedirect('操作成功','/admin/article/index');
            } else {
                javascriptRedirect('操作失败','/admin/article/index');
            }
=======
            gotoURL('操作成功','/admin/article/list/');
            exit;
>>>>>>> ccd86f27c8bc6d5fee623f785dfaec59dea54de4
        }
    }
}
