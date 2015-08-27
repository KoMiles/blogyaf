<?php
/**
 * M_Article 
 * 
 * @uses M
 * @uses _Model
 * @package 
 * @version $Id$
 * @author wangkongming <komiles@163.com> 
 * @date 2015-08-27 16:12:29
 */
class M_Article extends DbPdo {

    function __construct() {
        parent::__construct();
    }
    public function getArticle() {
        $sql = "select * from Article limit 2";


    }
}

