<?php
class ProductController extends Yaf_Controller_Abstract {
    /**
     * indexAction 
     * /index.php?m=index&c=article&a=index
     * @access public
     * @return void
     */
    public function indexAction() {
        echo "product index action";
        exit;
    }

    /**
     * detailAction 
     * /index.php?m=index&c=article&a=detail
     * @access public
     * @return void
     */
    public function detailAction() {
        echo " product detail action";
        exit;
    }
}

