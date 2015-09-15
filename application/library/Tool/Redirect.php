<?php
/**
 * Tool_Redirect 
 * 跳转工具类
 * @package 
 * @version $Id$
 * @author wangkongming <komiles@163.com> 
 * @date 2015-09-15 17:09:42
 */
class Tool_Redirect {

    /**
     * javascriptRedirect 
     * 采用javascript跳转，好处是有一个错误提示，同时还能跳转到其他页面，
     * 如果错误提示为空，直接javascript跳转,如果redirect为空，那么会跳回到浏览器的前一个页面
     * @param mixed $errorMsg 
     * @param mixed $redirect 
     * @static
     * @access public
     * @return void
     */
    public static function javascriptRedirect($errorMsg, $redirect = null )
    {
        $str = '';
        if($errorMsg){
            $str .= 'alert("'.$errorMsg.'");';
        }
        if($redirect){
            $str .= 'window.location.href="'.$redirect.'"';
        }else{
            $str .= 'window.history.back(-1);';
        }
        $str = '<script type="text/javascript">'.$str.'</script>';
        $start = <<<GOD
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">-
<html>-
    <head>-
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />-
    </head>-
    <body>
GOD;
        $end = <<<GOD
    <body>
GOD;
        $end = <<<GOD
    </body>
</html>
GOD;
        echo $start.$str.$end;
        exit(0);
    }




}
