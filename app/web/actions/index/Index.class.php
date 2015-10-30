<?php
/**
 * Created by PhpStorm.
 * User: zhangjianying
 * Date: 2015/9/30
 * Time: 14:12
 */
namespace Action\Index;
use Common\Base\Action;

class Index extends Action{
    public function call(){
        $data = array('a'=>'b','b'=>'c');
        $this->assign('data',$data);
        $this->display('index/index.php');
    }
}