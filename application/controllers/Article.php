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
        $request = $this->getRequest()->getParams();
        var_dump($request);
        $request = $this->getRequest()->getParam('name');
        var_dump($request);
        echo "index article action";
        exit;
    }

    /**
     * detailAction 
     * /index.php?m=index&c=article&a=detail
     * @access public
     * @return void
     */
    public function detailAction() {
        echo "index article detail action";
        exit;
    }
}

