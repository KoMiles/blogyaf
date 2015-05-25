<?php
/*=============================================================================
#     FileName: Article.php
#         Desc: 文章相关控制器
#       Author: wangkongming
#        Email: komiles@163.com
#     HomePage: http://www.wangkongming.cn/
#      Version: 0.0.1
#   LastChange: 2015-05-25 18:19:09
#      History:
=============================================================================*/
class ArticleController extends Yaf_Controller_Abstract {
    /**
     * indexAction 
     * /index.php?m=index&c=article&a=index
     * @access public
     * @return void
     */
    public function indexAction() {
        echo "index action";
    }
    /**
     * detailAction 
     * /index.php?m=index&c=article&a=detail
     * @access public
     * @return void
     */
    public function detailAction() {
        echo "detail action";
        exit;
    }
}

