<?php
class ProductController extends BasicController{
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
        $id = $this ->  getParam('id');
        var_dump($id);
        echo " product detail action";
        exit;
    }
}

