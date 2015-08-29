<?php
class Db_Pdo {
    //mysql　句柄
    private $pdo = null;
    
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
    public function __construct() {
        $master = Yaf_Registry::get("config")->database->master->toArray();
        $this->pdo = new PDO("mysql:host={$master['server']};dbname={$master['database']}","{$master['user']}","{$master['password']}");
        $this->pdo -> exec('set names utf8');
    }

    public function getRow($sql) {
        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
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
    }




}
