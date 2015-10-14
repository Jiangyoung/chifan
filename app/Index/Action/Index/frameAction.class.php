<?php
namespace Index\Action\Index;

use Common\Action\BaseAction;
use Common\Util\Http;

class frameAction extends BaseAction{
    function execute(){
        $case = Http::getGET('case');
        if('top' == $case){
            $this->render('index/frame_top.php');
        }else if('left' == $case){
            $this->render('index/frame_top.php');
        }else if('footer' == $case){
            $this->render('index/frame_top.php');
        }else{
            $this->render('index/frame_top.php');
        }
    }
}