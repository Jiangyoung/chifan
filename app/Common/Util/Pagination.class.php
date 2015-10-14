<?php
namespace Common\Util;

class Pagination {
    /*
     * @var \Common\Database\DbMysqli null
     */
    private $conn = null;
    private $sql = '';
    private $current_page = 1;
    private $max_row = 3;
    private $total_rows = 0;
    private $total_page = 1;
    private $nav_count = 5;

    function __construct($conn,$sql){
        $this->conn = $conn;
        $this->sql = $sql;
        $this->current_page = intval(Http::getGET('p',1));
        //当前请求页面不合理1
        if($this->current_page <= 0) $this->current_page = 1;

    }

    public function setMax_row($max_row){
        $this->max_row = $max_row;
    }

    public function getRows(){
        $start = (($this->current_page - 1) * $this->max_row);
        $offset = $this->max_row;

        $countSQL = preg_replace('/SELECT.*FROM/','SELECT COUNT(`id`) AS count FROM',$this->sql);

        $countRes = $this->conn->execute_dql($countSQL);
        $this->total_rows = $countRes[0]['count'];

        $this->total_page = ceil( floatval($this->total_rows) / floatval($this->max_row));
        //当前请求页面不合理2
        if($this->current_page > $this->total_page)$this->current_page = 1;

        $sql = $this->sql . 'LIMIT %d,%d';
        $sql = sprintf($sql,$start,$offset);

        $rows = $this->conn->execute_dql($sql);
        return $rows;

    }

    public function getTotal_rows(){
        return $this->total_page;
    }

    public function getTotal_page(){
        return $this->total_page;
    }

    public function getNav(){
        $navTpl = <<<AAA
<div class="page-nav"><hr/>
    %s &nbsp;|&nbsp;第%d页/共%d页
</div>
AAA;
        $aTpl = '&nbsp;<a href="%s">%s</a>&nbsp;';

        $prev_page = ($this->current_page>1)?($this->current_page-1):false;
        $next_page = ($this->current_page<$this->total_page)?($this->current_page+1):false;


        $a = '';
        $a .= sprintf($aTpl,$this->getLink(1),'首&nbsp;页');
        if($prev_page)$a .= sprintf($aTpl,$this->getLink($prev_page),'上一页');


        $nav_count = $this->nav_count;
        //导航开始位置 最小为1
        $flag = 1;
        //导航中间位置
        $middle_nav = ceil(floatval($nav_count)/floatval(2));

        //确定最小开始值
        while(($this->current_page) - $middle_nav > 0 ){
            $flag++;
        }

        for($i=1;$i<=$this->nav_count;$i++){
            if($flag > $this->total_page)break;
            if($this->current_page == ($flag)){
                $a .= '&nbsp;'.($flag).'&nbsp;';
                $flag++;
                continue;
            }
            $a .= sprintf($aTpl,$this->getLink($flag),'&nbsp;'.($flag).'&nbsp;');
            $flag++;
        }

        if($next_page)$a .= sprintf($aTpl,$this->getLink($next_page),'下一页');
        $a .= sprintf($aTpl,$this->getLink($this->total_page),'尾&nbsp;页');

        $nav = sprintf($navTpl,$a,$this->current_page,$this->total_page);

        return $nav;
    }

    private function getLink($page){
        $link = '';
        $currentUri = $_SERVER['REQUEST_URI'];
        if(empty($_GET)){
            $link = $currentUri.'?p='.$page;
        }else if(Http::getGET('p')){
            $link = preg_replace('/p=(.*)/','p='.$page,$currentUri);
        }else{
            $link = $currentUri.'&p='.$page;
        }
        return $link;
    }

}