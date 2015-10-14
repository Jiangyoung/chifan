<?php
/**
 * Created by PhpStorm.
 * User: Jiangyoung
 * Date: 2015/5/13
 * Time: 11:29
 */
namespace Common\Action;

trait Traits4listAction{
    public function execute(){

        $tpl = $this->getTplForList();
        $res = $this->getListResForList();
        $list = $res['rows'];
        if(!empty($res['rows'])){
            $list = $this->formatListForList($list);
        }
        $this->setRenderValues('list',$list);
        $this->setRenderValues('pageNav',$res['nav']);

        $this->render($tpl);
    }

    abstract function getListResForList();
    abstract function formatListForList($list);
    abstract function getTplForList();

}