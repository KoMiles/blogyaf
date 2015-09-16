<?php
/**
 * ArticleController 
 * 文章相关Api
 * @uses Yaf
 * @uses _Controller_Abstract
 * @package 
 * @version $Id$
 * @author wangkongming <komiles@163.com> 
 * @date 2015-09-16 18:59:25
 */
class ArticleController extends Yaf_Controller_Abstract {
    /**
     * getListAction 
     * 文章列表
     * @access public
     * @return void
     */
    public function getListAction() {
        $str = "this is article api ~!";
        //echo Tool_String::jsonData('success',$str);
        echo Tool_String::jsonView('success',$str);
        exit;
    }
}
