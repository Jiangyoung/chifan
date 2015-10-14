<?php
namespace Index\Action\Index;

use Common\Action\BaseAction;
use Index\Model\Equipment;
use Index\Model\Place;
use Index\Model\User;

class listAction extends BaseAction{
    function execute(){
        $this->setRenderValues('listName','概况管理');
        $count = array();
        $user = new User();
        $params = array(
            array('field'=>'deleted','sign'=>'=','value'=>'n')
        );
        $count['user_all'] = $user->getCount($params);
        $params = array(
            array('field'=>'type','sign'=>'=','value'=>1),
            array('field'=>'deleted','sign'=>'=','value'=>'n')
        );
        $count['user_type1'] = $user->getCount($params);
        $params[0]['value'] = 2;
        $count['user_type2'] = $user->getCount($params);
        $params[0]['value'] = 3;
        $count['user_type3'] = $user->getCount($params);

        $equipment = new Equipment();
        $params = array(
            array('field'=>'deleted','sign'=>'=','value'=>'n')
        );
        $count['equipment_all'] = $equipment->getCount($params);
        $params = array(
            array('field'=>'state','sign'=>'=','value'=>1),
            array('field'=>'deleted','sign'=>'=','value'=>'n')
        );
        $count['equipment_state1'] = $equipment->getCount($params);
        $params[0]['value'] = 2;
        $count['equipment_state2'] = $equipment->getCount($params);
        $params[0]['value'] = 3;
        $count['equipment_state3'] = $equipment->getCount($params);
        $params[0]['value'] = 4;
        $count['equipment_state4'] = $equipment->getCount($params);
        $params = array(
            array('field'=>'type','sign'=>'=','value'=>2),
            array('field'=>'deleted','sign'=>'=','value'=>'n')
        );
        $count['equipment_type2'] = $equipment->getCount($params);
        $params[0]['value'] = 3;
        $count['equipment_type3'] = $equipment->getCount($params);
        $params[0]['value'] = 4;
        $count['equipment_type4'] = $equipment->getCount($params);

        $place = new Place();
        $params = array(
            array('field'=>'deleted','sign'=>'=','value'=>'n')
        );
        $count['place_all'] = $place->getCount($params);

        $this->setRenderValues('count',$count);



        $this->render('index/index_list.php');
    }
}