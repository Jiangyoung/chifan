<?php
/**
 * Created by PhpStorm.
 * User: Jiangyoung
 * Date: 2015/5/12
 * Time: 12:50
 */
namespace Index\Action\Place;

use Common\Action\BaseAction;
use Common\Action\Traits4addAction;
use Common\Util\Http;
use Index\Model\Place;
use Index\Model\User;


class addAction extends BaseAction{
    use Traits4addAction;
    function getModelForInsert(){
        $model = new Place();
        return $model;
    }
    function getPostDataForInsert(){
        $model = $this->getModelForInsert();
        $admin_idTexts = $this->getAdmin_idTexts();
        return array(
            'name'=>'',
            'location'=>'',
            'locationTexts'=>$model->getLocationTexts(),
            'admin_ids'=>'',
            'admin_idTexts'=>$admin_idTexts,
            'remark'=>''
        );
    }
    function getTplForInsert(){
        return 'index/place_add.php';
    }
    function formatForInsert($params){
        $params['admin_ids'] = implode(',',$params['admin_ids']);
        return $params;
    }
    function afterForInsert($insert_id){
        Http::redirect('index.php?c=place&a=list');
    }

    function getAdmin_idTexts(){
        $user = new User();
        $params = array(
            array('field'=>'type','sign'=>'=','value'=>'1'),
            array('field'=>'deleted','sign'=>'=','value'=>'n')
        );
        $allUser = $user->getAll($params,array());
        $res = array();
        foreach($allUser as $user){
            $res[$user['id']] = $user['username'].'('.$user['nickname'].')';
        }
        return $res;
    }
}