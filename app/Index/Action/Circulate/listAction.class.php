<?php
/**
 * Created by PhpStorm.
 * User: Jiangyoung
 * Date: 2015/5/12
 * Time: 12:50
 */

namespace Index\Action\Circulate;

use Common\Action\BaseAction;
use Common\Action\Traits4listAction;
use Index\Model\Circulate;


class listAction extends BaseAction{
    use Traits4listAction;

    function init(){
        $this->setRenderValues('actionName','设备借还管理');
    }
    function getTplForList(){
        return 'index/circulate_list.php';
    }
    function getModelForList(){
        $model = new Circulate();
        return $model;
    }
    function getListResForList(){
        $model = $this->getModelForList();
        $res = $model->getList();
        return $res;
    }
    function formatListForList($params){
        $params['adminText'] = '';
        $params['equipmentText'] = '';
        return $params;
    }
}