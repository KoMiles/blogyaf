<?php
/**
 * Mysql 
 * 
 * @package 
 * @version $Id$
 * @author wangkongming <komiles@163.com> 
 * @date 2015-08-27 15:10:35
 */
class Mysql {
    //mysql　句柄
    protected $conn;
    
    /**
     * __construct 
     * 
     * @param mixed $host 
     * @param mixed $username 
     * @param mixed $password 
     * @param mixed $db 
     * @access public
     * @return void
     */
    public function __construct($host, $username, $password, $db) {
        $this->conn = mysql_connect($host, $username,$password);
        if(!$this->conn) {
            $this->error = 'Could not connet '.mysql_error();
        }
        if(empty($db)) {
            $this->error = 'db is not empty';
        }
        mysql_select_db($db,$this->conn);
    }

    /**
     * getAll 
     * 
     * @param mixed $sql 
     * @access public
     * @return void
     */
    public function getAll($sql) {


    }
    /**
     * __destruct 
     * 
     * @access public
     * @return void
     */
    public function __destruct() {
        mysql_close($this->conn);
    }




}
