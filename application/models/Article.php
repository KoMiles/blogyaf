<?php
/**
 * ArticleModel 
 * 
 * @uses Db
 * @uses _Pdo
 * @package 
 * @version $Id$
 * @author wangkongming <komiles@163.com> 
 * @date 2015-08-31 15:55:29
 */
class ArticleModel extends Db_Pdo {

    public function __construct() {
        parent::__construct();
        $this->table = "Article";
        self::debug(false);
    }

    /**
     * getArticlesList 
     * 文章列表
     * @param mixed $page 
     * @param mixed $pageSize 
     * @param string $status 
     * @access public
     * @return void
     */
    public function getArticlesList($page, $pageSize, $status = '') {
        $start = 0;
        if($page > 1) {
            $start = ($page-1) * $pageSize;
        }

        if(empty($status)) {
            $where = '';
        } else {
            $where = array('status' => $status);
        }

        $order = "create_ts desc ";
        $limit = " {$start} , {$pageSize} ";
        return $this  -> Where($where)-> Limit($limit) ->  Order($order)-> Select();
    }

    /**
     * getArticleTotal 
     * 文章总条数
     * @param string $status 
     * @access public
     * @return void
     */
    public function getArticleTotal($status = '') {
        if(empty($status)) {
            $where = '';
        } else {
            $where = array('status' => $status);
        }

        return $this  -> Where($where)-> Total();
    }
    /**
     * getArticleInfo
     * 获取单个文章的信息
     * @param mixed $id 
     * @access public
     * @return void
     */
    public function getArticleInfo($id) {
        if($id <= 0 ) {
            return false;
        }
        $where = array('id' => $id);

        return $this  -> Where($where)-> SelectOne();
    }
    /**
     * addArticle 
     * 添加文章
     * @param mixed $title 
     * @param mixed $author 
     * @param mixed $content 
     * @access public
     * @return void
     */
    public function addArticle($title, $author, $content){
        $add_data = array(
            'title' => $title,
            'author' => $author,
            'content' => $content,
            'update_ts' => time(),
            'create_ts' => time(),
        );
        return $this -> insert($add_data);
    }
    /**
     * updateArticle 
     * 修改文章
     * @param mixed $id 
     * @param mixed $title 
     * @param mixed $author 
     * @param mixed $content 
     * @access public
     * @return void
     */
    public function updateArticle($id, $title, $author, $content,$status){
        if($id <= 0) {
            return false;

        }
        $update_data = array(
            'title' => $title,
            'author' => $author,
            'content' => $content,
            'status' => $status,
            'update_ts' => time(),
        );
        return $this->UpdateByID($update_data,$id);
    }
    /**
     * deleteArticle 
     * 删除文章
     * @param mixed $id 
     * @access public
     * @return void
     */
    public function deleteArticle($id) {
        if($id <=0 ) {
            return false;
        }
        return $this->DeleteByID($id);
    }
}

