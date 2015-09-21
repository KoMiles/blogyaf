<?PHP 

class Tool_Curl {

    var $headers; 
    var $user_agent; 
    var $compression; 
    var $cookie_file; 
    var $proxy;

    var $user_pwd;
    var $cookie_str;

    protected $time_out = 3;
 
    //curl 执行超时的毫秒数
    protected $time_out_ms = null;

    const PRIVATE_KEY = '9xpMz@dp[#x0g+z!';
    private $signature = false;

    //默认关闭错误报告
    private $report_error = false;

    /**
     * reportError 开启错误报告 
     * 
     * @access public
     * @return void
     */
    public function reportError() {
        $this->report_error = true;
    }

    protected static function getSignature($request_array) {
        unset($request_array['_request_token']);
        ksort($request_array);
        $request_string = http_build_query($request_array);
        return sha1($request_string . self::PRIVATE_KEY);
    }

    protected static function validateRequest($request_data) {
        return $request_data['_request_token'] == self::getSignature($request_data);
    }

    public function sign() {
        $this->signature = true;
    }

    public static function validatePost() {
        return self::validateRequest($_POST);
    }

    private static $http_proxy;

    public function __construct($cookies=TRUE,$cookie='cookies.txt',$compression='gzip',$proxy='') { 
        $this->headers[] = 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg'; 
        $this->headers[] = 'Connection: Keep-Alive'; 
        $this->headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8'; 
        $this->user_agent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)'; 
        $this->compression=$compression; 
        $this->proxy=$proxy; 
        $this->cookies=$cookies; 
        if (!empty($this->cookies)) $this->cookie($cookie); 
    } 
    function cookie($cookie_file) {
        if (file_exists($cookie_file)) { 
            $this->cookie_file=$cookie_file; 
        } else { 
            fopen($cookie_file,'w') or $this->error('The cookie file could not be opened. Make sure this directory has the correct permissions'); 
            $this->cookie_file=$cookie_file; 
            fclose($this->cookie_file); 
        } 
    } 

    function get($url) { 
        $process = curl_init($url); 
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers); 
        curl_setopt($process, CURLOPT_HEADER, 0); 
        curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent); 
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, FALSE);
        if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file); 
        if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file); 
        if ($this->cookie_str == TRUE) curl_setopt($process, CURLOPT_COOKIE, $this->cookie_str); 
        if ($this->user_pwd == TRUE) curl_setopt($process, CURLOPT_USERPWD, $this->user_pwd); 
        curl_setopt($process,CURLOPT_ENCODING , $this->compression); 
        curl_setopt($process, CURLOPT_TIMEOUT, $this->time_out); 
        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1); 
        $return = curl_exec($process); 

        $errno = curl_errno($process);
        $error = curl_error($process);
        curl_close($process); 

        //处理异常
        if ($errno && $this->report_error) {
            throw new Exception($error, $errno);
        }

        return $return; 
    } 

    //
    function post($url,$data) {
        $process = curl_init($url); 
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, FALSE);

        curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers); 
        curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent); 

        if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file); 
        if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file); 
        if ($this->cookie_str == TRUE) curl_setopt($process, CURLOPT_COOKIE, $this->cookie_str); 
        if ($this->user_pwd == TRUE) curl_setopt($process, CURLOPT_USERPWD, $this->user_pwd); 

        curl_setopt($process, CURLOPT_ENCODING , $this->compression);
        if(is_int($this->time_out_ms) && $this->time_out_ms > 0){
            curl_setopt($process, CURLOPT_TIMEOUT_MS, $this->time_out_ms);
            curl_setopt($process, CURLOPT_NOSIGNAL, 1);            
        }
        else{
            curl_setopt($process, CURLOPT_TIMEOUT, $this->time_out); 
        }       

        if ($this->proxy)
            curl_setopt($process, CURLOPT_PROXY, $this->proxy);

        if ($this->signature) {
            $data['_request_token'] = self::getSignature($data);
        }

        if (is_array($data)) {
            $data = http_build_query($data);
        }
        curl_setopt($process, CURLOPT_POSTFIELDS, $data); 
        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($process, CURLOPT_POST, 1); 
        $return = curl_exec($process); 

        $errno = curl_errno($process);
        $error = curl_error($process);
        curl_close($process); 

        //处理异常
        if ($errno && $this->report_error) {
            throw new Exception($error, $errno);
        }

        return $return; 
    } 

    function error($error) {
        echo "<center><div style='width:500px;border: 3px solid #FFEEFF; padding: 3px; background-color: #FFDDFF;font-family: verdana; font-size: 10px'><b>cURL Error</b><br>$error</div></center>"; 
        die; 
    } 

    public function setTimeOut($time){
        $time = intval($time);
        if($time > 0){
            $this->time_out = $time; 
            $this->time_out_ms = null;
        }
        return true;
    }

    public function getTimeOut(){
        return $this->time_out; 
    }

    public function setTimeOutMs($milliseconds){
        $milliseconds = intval($milliseconds);
        if($milliseconds > 0){
            $this->time_out_ms = $milliseconds;
        }
        return true;
    }
 
    public function getTimeOutMs(){
        return $this->time_out_ms; 
    }

    /**
     * setUserPwd 将当前登录用户的s1的帐号密码传入过去 
     * 
     * @access public
     * @return void
     */
    public function setUserPwd() {
        $this->user_pwd = $_SERVER['PHP_AUTH_USER'].':'.$_SERVER['PHP_AUTH_PW'];
    }

    /**
     * setCookieStr 将当前登录用户的cookie信息传入过去 
     * 
     * @access public
     * @return void
     */
    public function setCookieStr() {
        $cookie_str = '';
        foreach($_COOKIE as $k=>$v) {
            $cookie_str .= $k.'='.$v.';';
        }
        $this->cookie_str = $cookie_str; 
    }


} 

?>
