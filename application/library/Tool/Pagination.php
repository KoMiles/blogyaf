<?php

/**
 * 分页类文件
 * 版权所有
 * @author      zqshuai <zqshuai@163.com>
 * @version     $Id: cls_pagination.php 320 2012-07-23 06:44:32Z xuxb $
 */
/*
 * 使用说明
 * $page = new Pagination;               //建立新对像
 * $page->file="yourFileName.php";       //设置文件名，默认为当前页
 * $page->pageVar="page";                //设置页面传递的参数名，默认为page
 * $page->setVar($valuesArr);            //设置要传递的变量数组,此函数必须在 set 前使用
 * $page->set(15,1000,1,1,2,4);        //设置相关参数，共六个，分别为“页面大小”，“总记录数”，“当前页数（一般不需设置）”，“选择的样式”，“头几页/最后几页页数”，“当前页的前几页/当前页面的后几页”
 * $page->output(0);                     //输出,为0时直接输出,否则返回一个字符串
 * $page->limit();                       //输出Limit子句。在sql语句中用法为 "SELECT * FROM TABLE $page->limit()";
 */

class Tool_Pagination
{
    var $output = '';                //页面输出结果 @var string;
    var $file;                  //使用该类的文件,默认为PHP_SELF @var string;
    var $siteUrl;               //该类文件所在的站点 如:http://book.kongfz.com;
    var $pageVar = "page";        //设置页面传递参数变量,默认为page @var string;
    var $pageSize;              //页面大小  @var integer;
    var $currPage;              //当前页面 @var integer;
    var $varStr;                //要传递的变量数组 @var array;
    var $totalPage;             //总页数 @var integer;
    var $totalRecord;           //总记录数 @var integer;
    var $headerFooterPageNum;   //头尾页数
    var $beforeAferPageNum;     //前后页数
    
    var $pageFormat = '';
    //旧的分页类
    const PAGE_TYPE_OLD = 1;

    //新的分页类
    const PAGE_TYPE_NEW = 2;

    //拍卖公司分页类
    const PAGE_TYPE_PMGS = 3;

    //符合yaf静态路由
    const PAGE_TYPE_STATIC = 4;

    /**
     * 分页设置
     * @access public
     * @param int $pageSize         页面大小 默认15
     * @param int $totalRec         总记录数
     * @param int $current          当前页数，默认会自动读取
     * @return void
     */
    function set($pageSize, $totalRec, $current = 0, $styleType = 1, $headerFooterPageNum = 2, $beforeAferPageNum = 4)
    {
        $this->totalPage           = ceil($totalRec / $pageSize);         //总页数
        $this->totalRecord         = $totalRec;                         //总记录数
        $current                   = $this->setCurrentPage($current);
        $this->currPage            = $current;                             //当前页
        $this->pageSize            = $pageSize;                            //每页大小
        $this->headerFooterPageNum = $headerFooterPageNum;      //头尾页数
        $this->beforeAferPageNum   = $beforeAferPageNum;          //前后页数

        if(!$this->file){
            $this->file = $_SERVER['PHP_SELF'];     //默认是PHP_SELF
        }

        if($this->totalPage >= 1){
            if($styleType == self::PAGE_TYPE_NEW){
                $this->setOutputPageNew($current);
            }
        }
    }

    /**
     * 设置当前页
     *
     * @access public
     * @param array $current   当前页
     * @return $current
     */
    function setCurrentPage($current)
    {
        if(!$current && isset($_GET[$this->pageVar])){
            $current = $_GET[$this->pageVar];
        }

        if(!$current && isset($_POST[$this->pageVar])){
            $current = $_POST[$this->pageVar];
        }

        if($current > $this->totalPage){
            $current = $this->totalPage;
        }

        if($current < 1){
            $current = 1;
        }

        return $current;

    }

    /**
     * 新的分页处理
     */
    function setOutPutPageNew($current)
    {
        $spanStrBegin        = '<span >';
        $spanCurrentStrBegin = '<span >';
        $spanStrEnd          = '</span>';

        $contactStr       = '...';
        $pageLinkStrBegin = $this->siteUrl . $this->varStr;

        if($this->varStr){
            $pageLinkStrEnd = '_' . $this->pageVar . '_';
        }else{
            $pageLinkStrEnd = $this->pageVar . '_';
        }

        $beforePageStr = '';
        $afterPageStr  = '';
        $headerPageStr = '';
        $footerPageStr = '';
        $middlePageStr = '';

        $this->output .= '共有' . $this->totalRecord . '项，共<font style="font-size:18px;" color="red">' . $this->totalPage . '</font>页<br /><br />';
        $this->output .= '<div style=" padding-left:30px;">';

        #处理上一页，下一页
        if($current == 1){
            $beforePageStr = '';
        }else{
            $beforePageStr = $spanStrBegin . '<a href=' . $pageLinkStrBegin . $pageLinkStrEnd . ($current - 1) . '/ title="第' . ($current - 1) . '页"> 上一页</a>' . $spanStrEnd;
        }

        if($current == $this->totalPage){
            $afterPageStr = '';
        }else{
            $afterPageStr = $spanStrBegin . '<a href=' . $pageLinkStrBegin . $pageLinkStrEnd . ($current + 1) . '/ title="第' . ($current + 1) . '页"> 下一页</a>' . $spanStrEnd;
        }

        $this->output .= $beforePageStr;
        $BaseNum = floor(($current - 1) / 10) * 10;
        $start   = $BaseNum + 1;
        $end     = $BaseNum + 13;

        if($end > $this->totalPage){
            $end = $this->totalPage;
        }

        #处理中间的页码
        if($this->totalPage > 0 && $this->totalPage < 14){
            $start = 1;
            for($i = $start; $i <= $end; $i++){
                if($current == $i){
                    $this->output .= $spanCurrentStrBegin . '<a href="' . $pageLinkStrBegin . $pageLinkStrEnd . $current . '/" class="current">' . $i . '</a>' . $spanStrEnd;
                }else{
                    $this->output .= $spanStrBegin . '<a href=' . $pageLinkStrBegin . $pageLinkStrEnd . $i . '/ title="第' . $i . '页"  >' . $i . '</a>' . $spanStrEnd;
                }
            }
        }else{
            #头两页和后两页的链接
            $firstLinkStr     = $spanStrBegin . '<a href=' . $pageLinkStrBegin . $pageLinkStrEnd . '1' . '/ title="第1页">1</a>' . $spanStrEnd .
                $spanStrBegin . '<a href=' . $pageLinkStrBegin . $pageLinkStrEnd . '2' . '/ title="第2页">2</a>' . $spanStrEnd;
            $lastLinkStr      = $spanStrBegin . '<a href=' . $pageLinkStrBegin . $pageLinkStrEnd . ($this->totalPage - 1) . '/ title="第' . ($this->totalPage - 1) . '页">' . ($this->totalPage - 1) . '</a>' . $spanStrEnd .
                $spanStrBegin . '<a href=' . $pageLinkStrBegin . $pageLinkStrEnd . $this->totalPage . '/ title="第' . $this->totalPage . '页">' . $this->totalPage . '</a>' . $spanStrEnd;
            $middleStartStr   = '';
            $middleCurrentStr = '';
            $middleEndStr     = '';

            if($current < 8){
                for($i = 1; $i <= 11; $i++){
                    if($current == $i){
                        $this->output .= $spanCurrentStrBegin . '<a href="' . $pageLinkStrBegin . $pageLinkStrEnd . $current . '/" class="current">' . $i . '</a>' . $spanStrEnd;
                    }else{
                        $this->output .= $spanStrBegin . '<a href=' . $pageLinkStrBegin . $pageLinkStrEnd . $i . '/ title="第' . $i . '页">' . $i . '</a>' . $spanStrEnd;
                    }
                }
                $this->output.= $spanStrBegin . $contactStr . $spanStrEnd . $lastLinkStr;
            }else if($current <= $this->totalPage - 7){
                $middleStartStr .= $firstLinkStr;
                $middleStartStr .= $spanStrBegin . $contactStr . $spanStrEnd;
                $startStep = $current - 4;

                if($startStep < 3){
                    $startStep = 3;
                }

                for($i = $startStep; $i < $current; $i++){
                    $middleStartStr .= $spanStrBegin . '<a href=' . $pageLinkStrBegin . $pageLinkStrEnd . $i . '/ title="第' . $i . '页">' . $i . '</a>' . $spanStrEnd;
                }

                $middleCurrentStr .= $spanCurrentStrBegin . '<a href="' . $pageLinkStrBegin . $pageLinkStrEnd . $current . '/" class="current">' . $current . '</a>' . $spanStrEnd;
                $endStep = $current + 4;
                if($endStep > ($this->totalPage - 2)){
                    $endStep = $this->totalPage - 3;
                }

                for($i = $current + 1; $i <= $endStep; $i++){
                    $middleEndStr .= $spanStrBegin . '<a href=' . $pageLinkStrBegin . $pageLinkStrEnd . $i . '/ title="第' . $i . '页">' . $i . '</a>' . $spanStrEnd;
                }

                $this->output.=$middleStartStr . $middleCurrentStr . $middleEndStr;
                $this->output.= $spanStrBegin . $contactStr . $spanStrEnd . $lastLinkStr;
            }else{
                $middleStartStr .= $firstLinkStr;
                $middleStartStr .= $spanStrBegin . $contactStr . $spanStrEnd;
                $this->output.= $firstLinkStr . $spanStrBegin . $contactStr . $spanStrEnd;
                for($i = $this->totalPage - 8; $i <= $this->totalPage; $i++){
                    if($current == $i){
                        $this->output .= $spanCurrentStrBegin . '<a href="' . $pageLinkStrBegin . $pageLinkStrEnd . $current . '/" class="current">' . $i . '</a>' . $spanStrEnd;
                    }else{
                        $this->output .= $spanStrBegin . '<a href=' . $pageLinkStrBegin . $pageLinkStrEnd . $i . '/ title="第' . $i . '页">' . $i . '</a>' . $spanStrEnd;
                    }
                }
            }
        }

        $this->output .= $afterPageStr;
        $this->output.='</div><div class="clear"></div>'; #</div>';

    }

    function setPageVar($pageVar)
    {
        $this->pageVar = $pageVar;

    }

    /**
     * 设置要传递的变量
     *
     * @access public
     * @param array $data   要传递的变量，用数组来表示，参见上面的例子
     * @return void
     */
    function setVar($data)
    {
        foreach($data as $k => $v){
            $this->varStr .= '&amp;' . $k . '=' . urlencode($v);
        }

    }

    /**
     * 分页结果输出
     * @access public
     * @param bool $returnStr 为真时返回一个字符串，否则直接输出，默认直接输出
     * @return string  1:返回一个字符串,0:直接输出.
     */
    public function output($ReturnStr = false)
    {
        if($ReturnStr){
            return $this->output;
        }else{
            echo $this->output;
        }

    }

    /**
     * 生成Limit语句
     * @access public
     * @return string
     */
    function limit()
    {
        return ' LIMIT ' . (($this->currPage - 1) * $this->pageSize) . ',' . $this->pageSize;

    }

    /**
     * 生成SelectLimit语句中的限制条件
     * @access public
     * @return array
     */
    function limitCondition()
    {
        return array(
            "rows"   => $this->pageSize,
            "offset" => ($this->currPage - 1) * $this->pageSize
        );

    }

    /**
     * 数组分页使用
     * @access public
     * @return string //返回当前页开始数组下标
     */
    function arrayInit()
    {
        return ($this->currPage - 1) * $this->pageSize;

    }
    
    /**
     * 根据前端需求，整理前端所需的分页数据
     * 
     * @param array $data 
     * @return array
     */
    public static function assemblePage($data)
    {
        $pageCurr     = isset($data['pageCurr'])     ? (int)$data['pageCurr']    : 1;
        $pageShow     = isset($data['pageShow'])     ? (int)$data['pageShow']    : 0;
        $recordBefore = isset($data['recordBefore']) ? (int)$data['recordBefore']: 0;
        $recordAfter  = isset($data['recordAfter'])  ? (int)$data['recordAfter'] : 0;
        $recordCount  = isset($data['recordCount'])  ? (int)$data['recordCount'] : 0;
        
        if($recordBefore > $pageShow){
            $recordBefore = $pageShow;
        }
        if($recordAfter > $pageShow){
            $recordAfter = $pageShow;
        }
        if($pageCurr > 0 && $pageShow > 0 && $recordCount> 0){
            $allPage =  ceil($recordCount / $pageShow);
            if($allPage <= $pageCurr){
                $pageCurr    = $allPage;
                $recordAfter = 0;
            }
        }
        if($recordBefore > 0){
            if($pageCurr <= 1){
                $recordBefore = 0;
            }
        }
        if($recordAfter > 0 && $recordCount > 0){
            $numAfter = $recordCount - $pageCurr * $pageShow;
            if($numAfter > 0 && $numAfter < $recordAfter){
                $recordAfter = $numAfter;
            }
        }
        
        $result = array(
            'pageCurr'     => $pageCurr,
            'pageShow'     => $pageShow,
            'recordBefore' => $recordBefore,
            'recordAfter'  => $recordAfter,
            'recordCount'  => $recordCount,
        );
        
        return $result;
    }
    
    /**
     * 生成分页
     * @param unknown $url url格式
     * @param number $pageCurr 当前页码
     * @param unknown $pageShow 每页数量
     * @param unknown $recordCount 总记录数
     * @author zhouchunhui
     * @date 2013/12/19
     * @return string
     */
    static public function markPhpPager($url, $pageCurr = 1, $pageShow, $recordCount)
    {
        $currClass = 'now';
        $pageCount = $pageShow ? ceil($recordCount / $pageShow) : 0;
        $pageCount = (int)$pageCount;
        $pageCurr = $pageCurr >= $pageCount ? $pageCount : $pageCurr;
        $recordEndTheory = $pageShow * $pageCurr;
        $recordStart = $recordEndTheory - $pageShow + 1;
        if($recordStart < 0){
            $recordStart = 0;
        }
        $recordEnd = $recordEndTheory == 0 || $recordEndTheory > $recordCount ? $recordCount : $recordEndTheory;
        $prevpage = $pageCurr == 1 ? 1 :  ($pageCurr - 1);
        $nextpage = $pageCurr + 1 >= $pageCount ? $pageCount : ($pageCurr + 1);
        $prevpageurl = ($prevpage == $pageCurr) ? "javascript:;" : str_replace('{page}', $prevpage, $url);

        $nextpageurl = ($nextpage == $pageCurr) ? "javascript:;" : str_replace('{page}', $nextpage, $url);
        $html =
        '<div class="pager_info_box"><em>'.$recordStart."</em>-<em>".$recordEnd."</em>条，共<b>".$recordCount.'</b>条</div>'.
        '<div class="pager_num_box">'.
        '<a class="pager_prev_btn'. ($pageCurr < 2 ? ' no_page' : '') .'" href="' .$prevpageurl. '">上一页</a>';
    
        //分页逻辑
        $pageHtml = '';
        if($pageCount < 12){
            for($i=0; $i<$pageCount; $i++){
                $thisurl = str_replace('{page}', ($i+1), $url);
                $pageHtml .= '<a ' . ($pageCurr == ($i + 1) ? 'class="' . $currClass . '" ' : '') . 'href="'. $thisurl .'">' . ($i+1) . '</a>';
            }
        }else if($pageCount >= 12){
            for($i=0; $i<$pageCount; $i++){
                $thisurl = str_replace('{page}', ($i+1), $url);
                if($i !== 0 && $i !== $pageCount - 1){
                    if($pageCurr > 6 && $pageCount-($i+1) > 9 && $pageCurr-($i+1) > 4){
                        if($i+1 === 2 ){
                            $pageHtml .= '<span>...</span>';
                        }
                        continue;
                    }
                    if($pageCount-$pageCurr > 5 && ($i+1) > 10 && ($i+1)-$pageCurr > 4){
                        if($i+1 === $pageCount-1){
                            $pageHtml .= '<span>...</span>';
                        }
                        continue;
                    }
                }
                $pageHtml .= '<a ' . ($pageCurr == ($i+1) ? 'class="' . $currClass. '" ' : '') . 'href="' .$thisurl. '">' . ($i+1) .'</a>';
            }
        }
        $html .= $pageHtml;
    
        $html .= '<a class="pager_next_btn'. ($pageCurr > $pageCount-1 ? ' no_page' : '' ) .'" href="'. $nextpageurl .'">下一页</a>'.
                '<span class="pager_input_box">到<input type="text" id="turnPageId" attrUrl= "'.$url.'" value="'. $pageCurr .'">页</span>'.
                '<a class="pager_turn_btn" href="javascript:;" onclick="var inputPageObj = document.getElementById(\'turnPageId\'); if(isNaN(inputPageObj.value)){ return false; }else{ location.href = inputPageObj.getAttribute(\'attrUrl\').replace(\'{page}\', inputPageObj.value);}">确定</a>'.
        '</div>';
        return $html;
    }
    
    /**
     * 分页设置
     * @access public
     * @param int $pageSize         页面大小 默认15
     * @param int $totalRec         总记录数
     * @param int $current          当前页数，默认会自动读取
     * @return void
     * @author wangkongming<komiles@163.com>
     */
    public  function setPage($pageSize = 15, $totalRec, $current = 0)
    {
        $this->currPage = $current; //当前页
        $this->pageSize = $pageSize; //每页大小
        $this->totalPage = ceil(intval($totalRec) / intval($pageSize));
        $this->totalRecord = $totalRec;

        if($current > $this->totalPage){
            $current = $this->totalPage;
        }

        if($current < 1){
            $current = 1;
        }
        
        if($this->totalPage <= 1){
            $this->output = '';
            return true;
        }

        $start = ($current - 1) * $pageSize + 1;
        $end = $current * $pageSize;
        $this->output .= '<div class="page_box">';
        $this->output .= '<div class="left">显示： '.$start.'-'.$end.'， 共'.$totalRec.'</div>';
        $this->output .= '<div class="right">';

        if($current > 1){
            $this->output .= '<a href="'.sprintf($this->pageFormat, $current-1).'"><< 上一页</a>';
        }
        
        if($this->totalPage < 10){
            for($i = 1; $i <= $this->totalPage; $i++){
                $class = $i == $current ? 'class="now"' : '';
                $this->output .= '<a '.$class.' href="'.sprintf($this->pageFormat, $i).'">'.$i.'</a>';
            }

        }else{
            $class = 1 == $current ? 'class="now"' : '';
            $this->output .= '<a '.$class.' href="'.sprintf($this->pageFormat, 1).'">1</a>';
            $this->output .= '<span>···</span>';
            
            for($i = $current - 4; $i <= $current + 4; $i++){
                if($i>1 && $i<$this->totalPage){
                    $class = $i == $current ? 'class="now"' : '';
                    $this->output .= '<a '.$class.' href="'.sprintf($this->pageFormat, $i).'">'.$i.'</a>';
                }
            }
            
            $this->output .= '<span>···</span>';
            $class = $this->totalPage == $current ? 'class="now"' : '';
            $this->output .= '<a '.$class.' href="'.sprintf($this->pageFormat, $this->totalPage).'">'.$this->totalPage.'</a>';
        }
        
        if($current < $this->totalPage){
            $this->output .= '<a href="'.sprintf($this->pageFormat, $current+1).'">下一页 >></a>';
        }

        $this->output .= '</div>';
        $this->output .= '<div class="clear"></div>';
        $this->output .= '</div>';
        
        return true;
    }
    
    /**
     * 设置分页样式
     */
    public function setPageFormat($format)
    {
        $this->pageFormat = $format;
    }
    
    /**
     * 分页设置
     * @access public
     * @param int $pageSize         页面大小 默认15
     * @param int $totalRec         总记录数
     * @param int $current          当前页数，默认会自动读取
     * @return void
     */
    function setAjax($pageSize = 15, $totalRec, $current = 0, $type='now')
    {
        $this->currPage = $current; //当前页
        $this->pageSize = $pageSize; //每页大小
        $this->totalPage = ceil(intval($totalRec) / intval($pageSize));
        $this->totalRecord = $totalRec;

        if($current > $this->totalPage){
            $current = $this->totalPage;
        }

        if($current < 1){
            $current = 1;
        }

        if($this->totalPage < 1){
            $this->output = '';
            return true;
        }elseif($this->totalPage == 1){
            $this->output = '<a></a>';
            return true;
        }
        
        $start = ($current - 1) * $pageSize + 1;
        $end = $current * $pageSize;
        $this->output .= '<div class="page_box">';
        $this->output .= '<div class="left">显示： '.$start.'-'.$end.'， 共'.$totalRec.'</div>';
        $this->output .= '<div class="right">';

        if($current > 1){
            $prevPage = $current-1;
            $this->output .= '<a data-page ="'.$prevPage.'" data-type="'.$type.'" href="javascript:;"><< 上一页</a>';
        }
        
        if($this->totalPage < 10){
            for($i = 1; $i <= $this->totalPage; $i++){
                $class = $i == $current ? 'class="now"' : '';
                $this->output .= '<a data-page ="'.$i.'" data-type="'.$type.'" '.$class.' href="javascript:;" >'.$i.'</a>';
            }
        }else{
            $class = 1 == $current ? 'class="now"' : '';
            $this->output .= '<a data-page ="'.$current.'" data-type="'.$type.'"'.$class.' href="javascript:;">1</a>';
            $this->output .= '<span>···</span>';
            
            for($i = $current - 4; $i <= $current + 4; $i++){
                if($i>1 && $i<$this->totalPage){
                    $class = $i == $current ? 'class="now"' : '';
                    $this->output .= '<a data-page ="'.$i.'" data-type="'.$type.'"'.$class.' href="javascript:;">'.$i.'</a>';
                }
            }
            
            $this->output .= '<span>···</span>';
            $class = $this->totalPage == $current ? 'class="now"' : '';
            $this->output .= '<a data-page ="'.$this->totalPage.'" data-type="'.$type.'"'.$class.' href="javascript:;">'.$this->totalPage.'</a>';
        }
        
        if($current < $this->totalPage){
            $nextPage = $current +1;
            $this->output .= '<a data-page ="'.$nextPage.'" data-type="'.$type.'" href="javascript:;">下一页 >></a>';
        }
        
        $this->output .= '</div>';
        $this->output .= '<div class="clear"></div>';
        $this->output .= '</div>';
        
        return true;
    }
}
