<?php
/**
 * Created by PhpStorm.
 * User: Jiangyoung
 * Date: 2015/5/17
 * Time: 9:54
 */
namespace Index\Action\User;

use Common\Action\BaseAction;
use Common\Util\Http;
use Index\Model\User;

class infoAction extends BaseAction {
    function init(){
        $this->setRenderValues('actionName','用户信息');
    }
    function execute(){
        $id = Http::getGET('id',0);
        if($id){

            $model = new User();
            $info = $model->getRowById($id);
            $this->setRenderValues('info',$info);
            $this->render('index/user_info.php');
        }
    }
}