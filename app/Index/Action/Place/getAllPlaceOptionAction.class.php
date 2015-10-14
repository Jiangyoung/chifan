<?php
/**
 * Created by PhpStorm.
 * User: Jiangyoung
 * Date: 2015/5/19
 * Time: 18:11
 */
namespace Index\Action\Place;

use Common\Action\BaseAction;
use Index\Model\Place;

class getAllPlaceOptionAction extends BaseAction {
    function execute(){
        $place = new Place();
        $list = $place->getList(array()," WHERE `deleted`='n' ",false);
        header("Content-Type:text/html;charset=utf-8");
        $optionTpl = '<option value="%s">%s(%s)</option>';
        if($list){
            foreach($list as $row){
                $row['locationText'] = $place->getLocationText($row['location']);
                echo sprintf($optionTpl,$row['id'],$row['name'],$row['locationText']);
            }
        }
    }
}