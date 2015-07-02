<?php

class Pagination {

	private $showPageCount = true;
	private $showGoto = true;
	private $showLast = false;
	private $max_page = -1;
	private $class = '';
	private $displayPageCount;
    private $always_show_edge = false;
    private $keyboard = false;

	private $urlPattern;
	private $firstPageUrl;

    private $js_mode = false;

	// 处理一个页面有多个分页的情况
	private static $myId = 1;
	private static $hasOutputJs = false;

	public function __construct($class = '', $displayPageCount = 9) {
		$this->class = $class;
		$this->displayPageCount = $displayPageCount;
	}

	public function showPageCount($bool) {
		$this->showPageCount = $bool ? true : false;
	}

	public function showGoto($bool) {
		$this->showGoto = $bool ? true : false;
	}

	public function showLastPage($bool) {
		$this->showLast = $bool ? true : false;
	}

    public function enableKeyboard() {
        $this->keyboard = true;
    }

    public function alwaysShowEdge($bool = true) {
        $this->always_show_edge = $bool ? true : false;
    }

    public function setMyId($id) {
        self::$myId = intval($id);
    }

	// $pattern = 'http://www.babytree.com/haha.php?page={page}';
	public function setUrlPattern($pattern) {
		if (preg_match('/\{page\}/', $pattern) == 1) {
			$this->urlPattern = $pattern;
			return true;
		}
		else
			return false;
	}

	public function setFirstPageUrl($url) {
		$this->firstPageUrl = $url;
	}

	public function setMaxPage($max_page) {
		$this->max_page = $max_page;
	}

    public function setJsMode($bool = true) {
        $this->js_mode = $bool ? true : false;
    }

	private function genUrl($page_no) {
		if ($page_no == 1 && $this->firstPageUrl)
			return $this->firstPageUrl;
		else
			return preg_replace('/\{page\}/', $page_no, $this->urlPattern);
	}

	public function render($page_now, $per_page, $total, $page_pos = 0) {
		if (($this->urlPattern || $this->js_mode) && $total > $per_page) {

			$id = self::$myId++;

			$page_total = ceil($total / $per_page);
			if ($this->max_page > -1) {
				$page_total = $this->max_page;
				if ($page_now > $this->max_page)
					$page_now = $this->max_page;
			}

			$display_page_count = $this->displayPageCount;

			$has_prev = 1 < $page_now;
			$has_next = $page_now < $page_total;

			$page_link_start = max(1, $page_now - floor($display_page_count / 2));
			$page_link_end = min($page_total, $page_link_start + $display_page_count - 1);

            $prevPageNo = $page_now - 1;
            $nextPageNo = $page_now + 1;

            $prevPageUrl = $this->genUrl($prevPageNo);
            $nextPageUrl = $this->genUrl($nextPageNo);

			if ($page_link_start == 1) {
				$page_link_end = min($page_total, $display_page_count);
			}
			else if ($page_link_end == $page_total) {
				$page_link_start = max(1, $page_total - $display_page_count + 1);
			}

			$class = $this->class ? " {$this->class}" : '';

			$html =
				"<div class=\"pagejump{$class}\">";

			if (!self::$hasOutputJs) {
				// goto
                if (!$this->js_mode) {
    				$html .=
    					"<script type=\"text/javascript\">";
                    if ($this->keyboard) {
                        $html .=
                            "if (jQuery) {
                                if (!page_keyborad) {
                                    jQuery(document).keyup(function(e) {
                                        // 39 37
                                        if(e.which) {
                                            keycode = e.which;
                                            srcobjname = e.target.nodeName.toLowerCase();
                                            src_type = e.target.getAttribute('type');
                                            if (src_type)
                                                src_type = src_type.toLowerCase()
                                        } else {
                                            keycode = e.keyCode;
                                            srcobjname = e.srcElement.tagName.toLowerCase();
                                            src_type = e.srcElement.getAttribute('type');
                                            if (src_type)
                                                src_type = src_type.toLowerCase()
                                        }
                                        if (!$(e.target).attr('contenteditable') && 'textarea' != srcobjname && !('input' == srcobjname && src_type == 'text')) {";
                        if ($has_prev)
                            $html .=
                                            "if (keycode == 37) {
                                                location.href = '{$prevPageUrl}';
                                            }";
                        if ($has_next)
                            $html .=
                                            "if (e.which == 39) {
                                                location.href = '{$nextPageUrl}';
                                            }";
                        $html .=
                                        "}
                                    });
                                    var page_keyborad = false;
                                }
                            }";
                    }
                    $html .=
    						"function commonPageGoto(id, urlPattern, page_total, firstPageUrl) {
    							var page = document.getElementById(\"commonPageGotoInput\" + id).value;
    							if (isNaN(page)) {
    								alert(\"需要输入正确的页码\");
    								return false;
    							}
    							else {
    								if (page > page_total || page < 1)
    									alert('输入的页码超过限制');
    								else {
    									if (page == 1 && firstPageUrl)
    										location.href = firstPageUrl;
    									else
    										location.href = urlPattern.replace(/\{page\}/, page);
    								}
    							}
    						}
    
    						function commonPageEnter(e, id, urlPattern, page_total, firstPageUrl) {
    							if(window.event) // IE
    								keynum = e.keyCode;
    							else if(e.which) // Netscape/Firefox/Opera
    								keynum = e.which;
    							if (keynum == 13)
    								commonPageGoto(id, urlPattern, page_total, firstPageUrl);
    						}
    					</script>";
					self::$hasOutputJs = true;
                }
			}

			if ($has_prev || $this->always_show_edge) {
				$firstPageUrl = $this->genUrl(1);
                if ($has_prev) {
                    if ($this->js_mode) {
                        $html .=
                            "<a href=\"javascript:void(0);\" page=\"1\">首页</a><a href=\"javascript:void(0);\" page=\"{$prevPageNo}\">上一页</a>";
                    } else {
                        $html .=
                            "<a href=\"{$firstPageUrl}\">首页</a><a href=\"{$prevPageUrl}\">上一页</a>";
                    }
                } else {
                    $html .=
                        "<a class=\"off\" href=\"javascript:void(0);\">首页</a><a class=\"off\" href=\"javascript:void(0);\">上一页</a>";
                }
			}

			$html .=
				$page_link_start > 1 ? '…' : '';

			for ($i = $page_link_start; $i <= $page_link_end; $i++) {
				if ($i == $page_now)
					$html .=
						"<span class=\"current\">{$i}</span>";
				else {
					$url = $this->genUrl($i);
                    if ($this->js_mode) {
                        $html .=
                            "<a href=\"javascript:void(0);\" page=\"{$i}\">{$i}</a>";
                    } else {
                        $html .=
                            "<a href=\"{$url}\">{$i}</a>";
                    }
                }
			}

			$html .=
				$page_link_end < $page_total ? '…' : '';

			if ($has_next || $this->always_show_edge) {
				$lastPageUrl = $this->genUrl($page_total);
                if ($has_next) {
                    if ($this->js_mode) {
                        $html .=
                            "<a href=\"javascript:void(0);\" page=\"{$nextPageNo}\">下一页</a><a href=\"javascript:void(0);\" page=\"{$page_total}\">末页</a>";
                    } else {
                        $html .=
                            "<a href=\"{$nextPageUrl}\">下一页</a><a href=\"{$lastPageUrl}\">末页</a>";
                    }
                } else {
                    $html .=
                        "<a class=\"off\" href=\"javascript:void(0);\">下一页</a><a class=\"off\" href=\"javascript:void(0);\">末页</a>";
                }
			}
            //此处分页不能用document.write来输出内容，在有些地方会产生问题，如bug8301
			$html .=
				$this->showPageCount ? "<span class=\"page-number\">共{$page_total}页</span> " : '';

			if ($this->showGoto && $page_total > 1) {
                if ($this->js_mode) {
				    $html .=
					    '<span class="goto">直接到' .
						    "<input class=\"goto-input\" type=\"text\" total=\"{$page_total}\" />页 </script>" .
						    "<input total=\"{$page_total}\" type=\"button\" class=\"submit\" value=\"确定\" /></span>";
                } else {
				    $html .=
					    '<span class="goto">直接到' .
						    "<input id=\"commonPageGotoInput{$id}\" class=\"goto-input\" type=\"text\" onkeypress=\"commonPageEnter(event, {$id}, '{$this->urlPattern}', {$page_total}, '{$this->firstPageUrl}');\" />页 " .
						    "<input onclick=\"commonPageGoto({$id}, '{$this->urlPattern}', {$page_total}, '{$this->firstPageUrl}');\" type=\"button\" class=\"submit\" value=\"确定\" /></span>";
                }
			}

			$html .=
				'</div>';

			return $html;

		}
		else {
			return false;
		}
	}

}

