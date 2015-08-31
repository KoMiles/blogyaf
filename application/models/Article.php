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
        self::debug(true);
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
}

