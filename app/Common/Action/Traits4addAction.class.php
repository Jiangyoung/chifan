<?php
/**
 * Created by PhpStorm.
 * User: Jiangyoung
 * Date: 2015/5/12
 * Time: 12:55
 */
namespace Common\Action;

trait Traits4addAction{

    function execute(){
        $renderTpl = $this->getTplForInsert();
        $postData = $this->getPostDataForInsert();
        $this->setRenderValues('postData',$postData);

        if($this->isPost){
            $model = $this->getModelForInsert();
            if($model->checkParams($_POST)){
                $params = $this->formatForInsert($this->posts);
                $insert_id = $model->insertOne($params);
                $this->afterForInsert($insert_id);
            }else{
                $this->addToken();
                $this->setRenderValues('postData',array_merge($postData,$_POST));
                $this->setRenderValues('errMsg',$model->getCheckErr());
                $this->render($renderTpl);
            }


        }else{

            $this->render($renderTpl);
        }
    }
    abstract function getModelForInsert();
    abstract function getPostDataForInsert();
    abstract function getTplForInsert();
    abstract function formatForInsert($params);
    abstract function afterForInsert($insert_id);
}