<?php
/**
 * Created by PhpStorm.
 * User: Jiangyoung
 * Date: 2015/5/12
 * Time: 12:50
 */

namespace Index\Action\Maintain;

use Common\Action\BaseAction;
use Common\Action\Traits4listAction;
use Index\Model\Maintain;

class listAction extends BaseAction{
    use Traits4listAction;

    function init(){
        $this->setRenderValues('actionName','设备维护管理');
    }
    function getTplForList(){
        return 'index/maintain_list.php';
    }
    function getModelForList(){
        $model = new Maintain();
        return $model;
    }
    function getListResForList(){
        $model = $this->getModelForList();
        $res = $model->getList();
        return $res;
    }
    function formatListForList($params){
        return $params;
    }
}