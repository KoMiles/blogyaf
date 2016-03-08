<?php
/**
 * Redis 
 * redis数据库链接
 * @package 
 * @version $Id$
 * @author wangkongming <komiles@163.com> 
 * @date 2016-03-08 19:47:39
 */
class Db_Redis {
    private static $redis=null;
    public function __construct($host,$port) {
        if(self::$redis == null) {
            self::$redis = new Redis();
        }
        $connect = self::$redis-> connect($host,$port);
    
        if(!$connect ) {
            die("redis数据库链接失败！");
        }
    }
    
    /**
     * set 
     * set命令
     * @param mixed $k 
     * @param mixed $v 
     * @access public
     * @return void
     */
    public function set($k,$v) {
        return self::$redis->set($k,$v);
    }
        
    public function get($k) {
        return self::$redis->get($k);
    }

}
