<?php
/**
 * Created by PhpStorm.
 * User: Jiangyoung
 * Date: 2015/5/12
 * Time: 12:50
 */

namespace Index\Action\Place;

use Common\Action\BaseAction;
use Common\Action\Traits4listAction;
use Index\Model\Place;
use Index\Model\User;

class listAction extends BaseAction{
    use Traits4listAction;

    function init(){
        $this->setRenderValues('actionName','实验室管理');
    }
    function getTplForList(){
        return 'index/place_list.php';
    }
    function getModelForList(){
        $model = new Place();
        return $model;
    }
    function getListResForList(){
        $model = $this->getModelForList();
        $res = $model->getList();
        return $res;
    }
    function formatListForList($params){
        $user = new User();
        $model = $this->getModelForList();
        foreach($params as $key => $row){
            $params[$key]['locationText'] = $model->getLocationText($row['location']);
            $admin_ids = explode(',',$row['admin_ids']);
            $admins = array();
            $adminTexts = array();
            foreach($admin_ids as $admin_id){
                $admins[$admin_id] = $user->getRowById($admin_id);
                $adminTexts[$admin_id] = $admins[$admin_id]['username'];
            }
            $params[$key]['adminTexts'] = $adminTexts;
        }

        return $params;
    }
}