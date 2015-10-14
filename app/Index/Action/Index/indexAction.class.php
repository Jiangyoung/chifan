<?php
/**
 * Created by PhpStorm.
 * User: Jiangyoung
 * Date: 2015/5/5
 * Time: 11:25
 */
namespace Index\Action\Index;
use Common\Action\BaseAction;
use Common\Util\Http;

class indexAction extends BaseAction{

    public function execute(){

        $this->display('app/index/index_left.php');

    }
}