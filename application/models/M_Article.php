<?php
class M_Article extends M_Model {

    function __construct() {
        $this->table = TB_PREFIX.'Article';
        parent::__construct();
    }

    // 查询文章列表
    public function getArticlesList($userID){
        $sql = 'select * from '.$this->table;
        return $this->Query($sql);
    }
}
