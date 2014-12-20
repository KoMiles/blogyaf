<?php

/*
 * 博客models
 */

class BlogPdoModels {
    public function __construct() {
    }
    
    public function getAllBlogs() {
        $dsn = 'mysql:dbname=blogyaf;host=127.0.0.1';
        $user = 'root';
        $password = '';

        try {
            $con = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
//        //删除一条数据
//        $sql    =   'delete from em_test where id = 2 limit 1 ';
//        $count = $con->exec($sql);
//                print("delete $count rows.\n");
        //查询数据
        $sql    =   'select * from em_test';
        //$re  =   $con->query($sql);
            $arr = array();
            foreach ($con->query($sql) as $row) {
                $arr[]  =   $row;
            }
        return $arr;
        }
        
    public function getOneBlogs() {
        $dsn = 'mysql:dbname=blogyaf;host=127.0.0.1';
        $user = 'root';
        $password = '';

        try {
            $con = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        
        $pre    =   $con->prepare('select * from em_test limit 1');
        $pre->execute();
        
        //查询数据
        $result = $pre->fetch(PDO::FETCH_ASSOC);
        var_dump($result);exit;
        }
}

