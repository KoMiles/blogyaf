<?php
class M_Article extends M_Model {

    function __construct() {
        $this->table = TB_PREFIX.'Article';
        parent::__construct();
    }

    // 查询文章列表
    public function getArticlesList(){
        //$sql = 'select * from '.$this->table;
        //return $this->Query($sql);
        return $this->Select();
    }
    /**
     * addArticle 
     * 
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
        var_dump($add_data);exit;
        return $this->insert($add_data);
    }
}
