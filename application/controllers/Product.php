<?php
//class ProductController extends BasicController{
class ProductController extends Yaf\Controller_Abstract{
    /**
     * indexAction 
     * @access public
     * @return void
     */
    public function indexAction() {
        echo "product index action";
        exit;
    }

    /**
     * detailAction
     * /product/detail/2
     * @access public
     * @return void
     */
    public function detailAction() {
        $id = $this->getRequest()->getParam('id');
        var_dump($id);
        echo " product detail action";
        exit;
    }
    public function infoAction() {
        $id = $this->getRequest()->getParam('id');
        var_dump($id);
        echo " product info action";
        exit;
    }
}

