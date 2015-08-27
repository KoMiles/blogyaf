<?php
/**
 * M_Article
 * 文章相关models
 * @uses M
 * @uses _Model
 * @package
 * @version $Id$
 * @author wangkongming <komiles@163.com> 
 * @date 2015-06-11 11:59:06
 */
class M_Article extends M_Model {

    function __construct() {
        $this->table = TB_PREFIX.'Article';
        parent::__construct();
    }

    // 查询文章列表
    public function getArticlesList($page, $pageSize, $status = 'normal'){
        $start = 0;
        if($page > 1) {
            $start = ($page-1) * $pageSize;
        }
        $limit = " {$start} , {$pageSize} ";
        $this->Limit($limit);
        //$this->Where(array('status' => $status));
        $this->Where("status='{$status}'");
        $this->Order('create_ts desc ');
        //echo '$this->generateSQL();
        return $this->Select();
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
        return $this->insert($add_data);
    }

    /**
     * updateArticle 
     * 更新文章
     * @param mixed $id 
     * @param mixed $title 
     * @param mixed $author 
     * @param mixed $content 
     * @access public
     * @return void
     */
    public function updateArticle($id, $title, $author, $content){
        $update_data = array(
            'title' => $title,
            'author' => $author,
            'content' => $content,
            'update_ts' => time(),
        );
        return $this->UpdateByID($update_data,$id);
    }

    /**
     * getArticleInfo 
     * 获取单个文章的内容
     * @param mixed $id 
     * @access public
     * @return void
     */
    public function getArticleInfo($id) {
        if($id <=0 ) {
            return array();
        }
        return $this->SelectByID('',$id);
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

    /**
     * getArticlesCount
     * 文章记录数
     * @param string $status
     * @access public
     * @return void
     */
    public function getArticlesCount($status = 'normal') {
        $this->Where(array('status' => $status));
        return $this->Total();
    }
}
