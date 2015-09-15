<?php
/**
 * Tool_String 
 * 字符串工具类
 * @package 
 * @version $Id$
 * @author wangkongming <komiles@163.com> 
 * @date 2015-09-15 17:15:05
 */
class Tool_String {
    /**
     * getRandom 
     * 随机获取一个字符串
     * @param int $length 
     * @param int $type 
     * @static
     * @access public
     * @return void
     */
    public static function getRandom($length = 4, $type = 1) {
        switch ($type) {
        case 1:
            $string = '1234567890';
            break;

        case 2:
            $string = 'abcdefghijklmnopqrstuvwxyz';
            break;

        case 3:
            $string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;

        case 4:
            $string = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;

        case 5:
            $string = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
        }
        $output = '';
        for ($i = 0; $i < $length; $i++) {
            $pos = mt_rand(0, strlen($string) - 1); 
            $output .= $string[$pos];
        }
        return $output;
    }
    /**
     * getRealIP 
     * 获取用户的ip
     * @static
     * @access public
     * @return void
     */
    public static function getRealIP() {
        $ip = false;
        if(!empty($_SERVER["HTTP_CLIENT_IP"])) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
            if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
            for ($i = 0; $i < count($ips); $i++) {
                if (!preg_match ("/^(10|172.16|192.168)\./i", $ips[$i])) {
                    $ip = $ips[$i];
                    break;
                }
            }
        }
        return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
    }
}
