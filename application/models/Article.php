<?php
class ArticleModel {

    function __construct() {
    }
    public function getArticle() {
        return "this is ArticleModels";
    }
    public function getArticleBySql() {
        $db = new Db_Pdo();
        $table = "Article";
        $sql = "select * from Article limit 1";
        $result = $db ->getRow($sql);
        return $result;
    }
}

