<?php
class Tool_Json {
    /**
     * 生成ajax响应信息
     * @param boolean $status 执行状态
     * @param array   $data   返回的数据
     * @param string  $error  错误信息
     * @param array   $pager  分页相关参数
     * @return string
     */
    public static function getView($status, $data = array(), $error = "", array $pager = array(), $append = array(), $errType = '0')
    {
        $data = array(
            'status' => $status,
            'data' => $data,
            'message' => $error
        );
        if (!empty($pager)) {
            $data['pager'] = $pager;
        }
        if (!empty($append)) {
            $data['append'] = $append;
        }
        $data['errType'] = $errType;
        return json_encode($data);
    }
    public static function jsonData() {



    }
}
