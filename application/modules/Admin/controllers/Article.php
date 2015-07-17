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
        $this->homeUrl = '/admin/article';
    }

    /**
     * indexAction
     * 文章管理首页
     * @access public
     * @return void
     */
    public function indexAction() {
        $pageSize = 8;
        $page = $this->getQuery("page") ? $this->getQuery("page") : 1;
        $article_list = $this->m_article->getArticlesList($page, $pageSize);
        foreach ($article_list as $key => $row) {
            $article_list[$key]['date'] = date('Y-m-d H:i:s',$row['create_ts']);
            $article_list[$key]['statusCn'] = $row['status'] == 'normal' ? '正常' : '已删除';
        }
        $total_num = $this->m_article -> getArticlesCount();

        $page_string = generatePageLink($page, $pageSize, $total_num, "/admin/article/index");
        echo $page_string;

        $this->getView()->assign('page_string', $page_string);
        $this->getView()->assign('article_list', $article_list);
        $this->getView()->display('index.html');
        exit;
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
            $id = $this->getPost('id') ;
            //编辑文章
            $result = $this->m_article->updateArticle($id,$title, $author, $content);
        }
        if($result) {
            javascriptRedirect('操作成功','/admin/article/index');
        } else {
            javascriptRedirect('操作失败','/admin/article/index');
        }
        exit;
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
            if($result) {
                javascriptRedirect('操作成功','/admin/article/index');
            } else {
                javascriptRedirect('操作失败','/admin/article/index');
            }
        }
    }
    /**
     * detailAction 
     * 
     * @access public
     * @return void
     */
    public function detailAction() {
        $id = $this->getQuery('id');
        if ($id <= 0) {
            $error_msg = "参数错误！";
        }

        $article_info = $this ->m_article ->getArticleInfo($id);
        $this->getView()->assign('article_info',$article_info);
        $this->getView()->display('detail.html');
        exit();
    }
}
