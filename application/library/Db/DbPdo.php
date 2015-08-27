<?php
class DbPdo {
    //mysql　句柄
    $pdo = null;
    
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
        
        $this->pdo = new PDO("mysql:host＝{$host};dbname={$db}","{$username}","{$db}");
    }

    public function getRow($sql) {
        $result = $this->pdo->query($sql);
        return $result;
    }
    /**
     * getAffectNum 
     * 执行修改或者删除时，sql语句影响的条数
     * @param mixed $sql 
     * @access public
     * @return void
     */
    public function getAffectNum($sql) {
        $result = $this->pdo->exec($sql);
        return $result;
    }
    /**
     * getAll 
     * 
     * @param mixed $sql 
     * @access public
     * @return void
     */
    public function getAll($sql) {
        $result = $this->pdo->query($sql);
        return $result;
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
