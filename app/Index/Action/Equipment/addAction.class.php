<?php
namespace Index\Action\Equipment;

use Common\Action\BaseAction;
use Common\Action\Traits4addAction;
use Common\Util\Http;
use Index\Model\Equipment;
use Index\Model\Place;

class addAction extends BaseAction{
    use Traits4addAction;
    protected function init(){
        $this->setRenderValues('actionName','添加设备');
    }

    function getModelForInsert(){
        $model = new Equipment();
        return $model;
    }
    function getPostDataForInsert(){
        $model = $this->getModelForInsert();
        $typeTexts = $model->getTypeTexts();
        $place = new Place();
        $places = $place->getList(array()," WHERE `deleted`='n' ",false);
        return array(
            'name'=>'',
            'locationText'=>'',
            'typeTexts'=>$typeTexts,
            'model'=>'',
            'description'=>'',
            'remark'=>'',
            'amount'=>1,
            'place'=>0,
            'photo_path'=>'',
            'places'=>$places['rows']
        );
    }
    function getTplForInsert(){
        return 'index/equipment_add.php';
    }
    function formatForInsert($params){
        $params['p_id'] = $params['place'];
        return $params;
    }
    function afterForInsert($insert_id){
        Http::redirect('index.php?c=equipment&a=list');
    }
}