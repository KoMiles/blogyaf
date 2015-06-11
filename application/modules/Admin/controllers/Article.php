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
     * modifyAction 
     * 修改文章
     * @access public
     * @return void
     */
    public function modifyAction() {
        //post方式获取参数
        $type = $this->getPost('type') ;
        $title = $this->getPost('title') ;
        $author = $this->getPost('author') ;
        $content = $this->getPost('content') ;
        if($type == 'add') {
            //添加文章
            $result = $this->m_article->addArticle($title, $author, $content);
        } else if($type == 'edit') {
            //编辑文章
            $result = $this->m_article->updateArticle($id,$title, $author, $content);
        }
        var_dump($result);
    }

    public function viewAction() {
        //获取参数
        $op = $this  ->getRequest() ->  getParam('op');
        $id = $this -> getRequest() ->  getParam('id');
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
        } else {
            //执行删除操作
            $result = $this->m_article->deleteArticle($id);
            var_dump($result);
           // jsRedirect('/admin/article/index/');
        }
    }
}
