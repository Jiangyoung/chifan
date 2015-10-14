<?php
namespace Index\Action\User;

use Common\Action\BaseAction;
use Common\Action\Traits4listAction;
use Common\Util\Http;
use Index\Model\User;

class listAction extends BaseAction{
    use Traits4listAction;

    protected function init(){
        $this->setRenderValues('actionName','用户管理');
    }

    function getModelForList(){
        $model = new User();
        return $model;
    }
    function getListResForList(){


        $model = $this->getModelForList();

        $type = Http::getGET('type',0);
        $res = array();
        if($type != 0){
            $res = $model->getList(array()," WHERE `type`='{$type}' AND `deleted`='n'");
        }else {
            $res = $model->getList();
        }
        return $res;
    }

    function getTplForList(){
        $tpl = 'index/user_list.php';
        return $tpl;
    }

    function formatListForList($list){
        //在model里的formatList 已经有一次处理
        return $list;
    }

}