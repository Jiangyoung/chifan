<?php
/**
 * Created by PhpStorm.
 * User: Jiangyoung
 * Date: 2015/5/19
 * Time: 23:56
 */
namespace Common\Action;

trait Traits4deleteAction {
    function execute(){

        $model = $this->getModelForDeleted();
        $conditions = $this->getConditionsForDeleted();
        $res = $model->delete($conditions,'AND');
        $this->afterDeleted($res);

    }

    abstract function getModelForDeleted();
    abstract function getConditionsForDeleted();
    abstract function afterDeleted($res);
}