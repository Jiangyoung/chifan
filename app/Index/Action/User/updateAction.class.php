<?php
/**
 * Created by PhpStorm.
 * User: Jiangyoung
 * Date: 2015/5/16
 * Time: 12:00
 */
namespace Index\Action\User;

use Common\Action\BaseAction;
use Common\Util\Http;
use Index\Model\User;

class updateAction extends BaseAction{
    protected function init(){
        $this->setRenderValues('actionName','用户信息修改');
    }
    function execute(){
        /*
        if(5 != $_SESSION['_USER_INFO']['type']){

        }
        */
        if($this->isPost){

        }else{
            $id = Http::getGET('id');
            $user = new User();
            $userInfo  = $user->getRowById($id);
            $this->setRenderValues('postData',$userInfo);
            $this->addToken();
            $this->render('index/user_add.php');
        }
    }
}