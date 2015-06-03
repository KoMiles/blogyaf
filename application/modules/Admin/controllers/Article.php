<?php

/**
 * ArticleController 
 * 
 * @uses BasicController
 * @package 
 * @version $Id$
 * @author wangkongming <komiles@163.com> 
 */
class ArticleController extends BasicController {

	private $m_article;

	private function init(){
		//Yaf_Registry::get('adminPlugin')->checkLogin();

		$this->m_article = $this->load('Article');
		$this->homeUrl = '/admin/article';
	}

	public function indexAction(){
        echo 'article admin index';
	}


}
