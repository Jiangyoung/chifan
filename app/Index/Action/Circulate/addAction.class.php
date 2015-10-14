<?php
namespace Index\Action\Circulate;

use Common\Action\BaseAction;
use Common\Action\Traits4addAction;
use Common\Util\Http;
use Index\Model\Circulate;

class addAction extends BaseAction{
    use Traits4addAction;
    protected function init(){
        $this->setRenderValues('actionName','添加设备借还/维护');
    }
    function getModelForInsert(){
        $model = new Circulate();
        return $model;
    }
    function getPostDataForInsert(){
        return array(
            'placeText'=>'gx',
            'remark'=>'',
            'user_remark'=>'',
            'nickname'=>'',
            'email'=>'',
            'phone'=>''
        );
    }
    function getTplForInsert(){
        return 'index/circulate_add.php';
    }
    function formatForInsert($params){
        return $params;
    }
    function afterForInsert($insert_id){
        Http::redirect('index.php?c=circulate&a=list');
    }
}