<?php
/**
 * Created by PhpStorm.
 * User: Jiangyoung
 * Date: 2015/5/16
 * Time: 13:35
 */
namespace Index\Action\Equipment;

use Common\Action\BaseAction;
use Common\Action\Traits4listAction;
use Common\Util\Http;
use Index\Model\Equipment;
use Index\Model\Place;

class listAction extends BaseAction{
    use Traits4listAction;
    protected function init(){
        $this->setRenderValues('actionName','设备列表');
    }
    function getTplForList(){
        return 'index/equipment_list.php';
    }
    function getListResForList(){
        $model = $this->getModelForList();
        $type = Http::getGET('type',0);
        $state = Http::getGET('state',0);
        $p_id = Http::getGET('p_id',0);
        $extra = '';
        if($type){
            $extra .= " `type`='{$type}' ";
        }
        if($state){
            if(!empty($extra)) $extra .= ' AND ';
            $extra .= " `state`='{$state}' ";
        }
        if($p_id){
            if(!empty($extra)) $extra .= ' AND ';
            $extra .= " `p_id`='{$p_id}' ";
        }
        if(!empty($extra)){
            if(!empty($extra)) $extra .= ' AND ';
        }
        $extra = ' WHERE '.$extra." `deleted`='n' ";
        $res = $model->getList(array(),$extra);
        return $res;
    }
    function getModelForList(){
        $model = new Equipment();
        return $model;
    }
    function formatListForList($params){
        $model = $this->getModelForList();
        $placeModel = new Place();
        foreach($params as $k => $row){
            $params[$k]['typeText'] = $model->getTypeText($row['type']);
            $params[$k]['stateText'] = $model->getStateText($row['state']);
            $extra = " WHERE `id`='{$row['p_id']}' ";
            $place = $placeModel->getOne(array(),'ASC',$extra);
            $params[$k]['placeText'] = $placeModel->getLocationText($place['location']);
        }
        return $params;
    }
}