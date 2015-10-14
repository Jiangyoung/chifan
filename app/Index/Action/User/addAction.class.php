<?php
namespace Index\Action\User;
use Common\Util\Http;
use Index\Model\User;
use Common\Action\BaseAction;
use Common\Action\Traits4addAction;

class addAction extends BaseAction{
    use Traits4addAction;
    protected function init(){
        $this->setRenderValues('actionName','添加用户');
    }

    function getModelForInsert(){
        $model = new User();
        return $model;
    }

    function getTplForInsert(){
        return 'index/user_add.php';
    }
    function getPostDataForInsert(){
        $model = $this->getModelForInsert();
        $typeTexts = $model->getTypeTexts();
        $postData =  array(
            'username'=>'',
            'nickname'=>'',
            'type'=>'',
            'typeTexts'=>$typeTexts,
            'password'=>'',
            'password2'=>'',
            'phone'=>'',
            'email'=>'',
            'remark'=>'',
            'photo_path'=>''
        );
        return $postData;
    }
    function formatForInsert($params){
        $params['create_time'] = time();
        $params['password'] = md5($params['password']);
        return $params;
    }

    function afterForInsert($insert_id){
        Http::redirect('index.php?c=user&a=list');
    }
}