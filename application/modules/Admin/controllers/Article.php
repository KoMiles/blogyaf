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
class ArticleController extends Yaf_Controller_Abstract {
    private $m_article;

    private function init(){
        //Yaf_Registry::get('adminPlugin')->checkLogin();
        $this->m_article = new ArticleModel();
        $this->homeUrl = '/admin/article';
        $this->getView()->assign('user_ip', Tool_String::getRealIP());
    }

    /**
     * indexAction
     * 文章管理首页
     * @access public
     * @return void
     */
    public function indexAction() {
        $pageSize = 10;
        $page = $this->getRequest()->getQuery("page") ? $this->getRequest()->getQuery("page") : 1;
        //$page = $this->getRequest()->getParam("page") ? $this->getRequest()->getParam("page") : 1;
        $article_list = $this->m_article->getArticlesList($page, $pageSize);
        foreach ($article_list as $key => $row) {
            $article_list[$key]['date'] = date('Y-m-d H:i:s',$row['create_ts']);
            $article_list[$key]['statusCn'] = $row['status'] == 'normal' ? '正常' : '审核中';
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
    /**
     * modifyAction 
     * 修改文章
     * @access public
     * @return void
     */
    public function modifyAction() {
        //post方式获取参数
        $type = $this -> getRequest() -> getPost('type') ;
        $title = $this-> getRequest() -> getPost('title') ;
        $author = $this->getRequest() -> getPost('author') ;
        $content = $this->getRequest() -> getPost('content') ;
        if($type == 'add') {
            //添加文章
            $result = $this->m_article->addArticle($title, $author, $content);
        } else if($type == 'edit') {
            $id = $this-> getRequest() -> getPost('id') ;
            //编辑文章
            $result = $this->m_article->updateArticle($id,$title, $author, $content, $status);
        }
        if($result) {
            Tool_Redirect::javascriptRedirect('操作成功','/admin/article/index');
        } else {
            Tool_Redirect::javascriptRedirect('操作失败','/admin/article/index');
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
        $op = $this  ->getRequest() ->  getParam('op') ? $this -> getRequest() -> getParam('op') : 'add';
        $id = $this -> getRequest() ->  getParam('id') ? $this -> getRequest() ->  getParam('id') : 0 ;

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
                Tool_Redirect::javascriptRedirect('操作成功','/admin/article/index');
            } else {
                Tool_Redirect:: javascriptRedirect('操作失败','/admin/article/index');
            }
        }
        exit;
    }

}
