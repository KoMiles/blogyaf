<?php

/*
 * 博客models
 */

class BlogModels {
    public function __construct() {
        $server =   "localhost";
        $username =   "root";
        $password =   "";
        $con    = mysql_connect($server, $username, $password);
        
        if (!$con)  {
            die('Could not connect: ' . mysql_error());
        }

        $db_selected = mysql_select_db("blogyaf", $con);

        if (!$db_selected) {
            die ("Can\'t use blogyaf : " . mysql_error());
        } else {
            echo '数据库链接成功~！';
        }
        mysql_close($con);
    }
    
    public function getAllBlogs() {
        $server =   "localhost";
        $username =   "root";
        $password =   "";
        $con    = mysql_connect($server, $username, $password);
        
        if (!$con)  {
            die('Could not connect: ' . mysql_error());
        }

        mysql_select_db("blogyaf", $con);
        mysql_query('set names utf8');
        $sql    =   "select gid,title,date from em_blog order by date desc ";
        $re     = mysql_query($sql);
        $result = array();
        while ($row = mysql_fetch_assoc($re)) {
            $result[]=$row;
        }
        return $result;
        mysql_close($con);
    }
}

