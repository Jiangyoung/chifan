<?php
/**
 * Created by PhpStorm.
 * User: Jiangyoung
 * Date: 2015/5/19
 * Time: 23:58
 */
namespace Index\Action\Equipment;

use Common\Action\BaseAction;
use Common\Action\Traits4deleteAction;
use Index\Model\Equipment;
use Common\Util\Http;

class deleteAction extends BaseAction {
    use Traits4deleteAction;
    function getModelForDeleted(){
        $model = new Equipment();
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