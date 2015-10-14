<?php
/**
 * Created by PhpStorm.
 * User: Jiangyoung
 * Date: 2015/5/20
 * Time: 0:00
 */
namespace Index\Action\User;

use Common\Action\BaseAction;
use Common\Action\Traits4deleteAction;
use Index\Model\User;
use Common\Util\Http;

class deleteAction extends BaseAction {
    use Traits4deleteAction;
    function getModelForDeleted(){
        $model = new User();
        return $model;
    }
    function getConditionsForDeleted(){
        $id = intval(Http::getPOST('id',0));
        if($id <= 0){
            $this->responseMsg(1,'Wrong Argument!');
        }
        $conditions = array(
            array('field'=>'id','sign'=>'=','value'=>$id)
        );
        return $conditions;
    }
    function afterDeleted($res){
        if($res){
            $this->responseMsg(0,'操作成功');
        }else{
            $this->responseMsg(1,'未知情况');
        }

    }
}