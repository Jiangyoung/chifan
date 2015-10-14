<?php
namespace Common\Model;

use Common\Database\DbMysqli;
use Common\Register;
use Common\Util\CheckParam;
use Common\Util\Pagination;

abstract class BaseModel {
    protected $tbName = '';
    protected $tbFields = array();
    /**
     * @var \Common\Database\DbMysqli null
     */
    private $conn = null;
    /**
     * @var \Common\Util\CheckParam null
     */
    private $check = null;

    function __construct(){
    }

    /**
     * @return DbMysqli
     */
    function getConnect(){
        if(!$this->conn){
            if(!Register::_get('db_conn')){
                $this->conn = new DbMysqli($this->tbName,$this->tbFields);
                Register::_set('db_conn',$this->conn);
            }else{
                $this->conn = Register::_get('db_conn');
            }

        }
        return $this->conn;
    }

    /**
     * @return CheckParam
     */
    function getCheck(){
        if(!$this->check){
            $this->check = new CheckParam();
        }
        return $this->check;
    }

    /**
     * 过滤参数，只保留表里存在的字段
     * @param array $tbFields 表字段
     * @param array $params 参数
     * @return array
     */
    public function filterParams($tbFields,$params){
        $resultParams = array();
        foreach($tbFields as $filed){
            if(isset($params[$filed])){
                $resultParams[$filed] = $params[$filed];
            }
        }
        return $resultParams;
    }


    /**
     * @param $params
     * @return bool
     */
    public function checkParams($params){
        return true;
    }

    /**
     * @return array
     */
    public function getCheckErr(){
        return $this->getCheck()->getError();
    }

    /**
     * @param $id
     * @param array $fields
     * @return array
     */
    public function getRowById($id,$fields=array()){
        $conn = $this->getConnect();
        if(empty($fields)){
            $fields = $this->tbFields;
            $fields[] = 'deleted';
        }
        $res = $conn->getRowById($id,$this->tbName,$fields);
        if('y' == $res['deleted'])$res = array();
        return $res;
    }

    /**
     * @param array $params
     * @return int
     */
    public function insertOne($params){
        $conn = $this->getConnect();
        $params = $this->filterParams($this->tbFields,$params);
        $insert_id = $conn->insertOne($this->tbName,$params);
        return $insert_id;
    }

    public function update($params,$extra){
        $params = $this->filterParams($this->tbFields,$params);
        $conn = $this->getConnect();
        $sql = $conn->assembleUpdateSQL($this->tbName,$params,$extra);
        $res = $conn->execute_dml($sql);
        return $res;
    }


    public function getCount($params,$condition='AND'){
        $conn = $this->getConnect();
        $sql = $conn->assembleCountSQL($this->tbName,$params,$condition);
        $res = $conn->execute_dql($sql);
        if(isset($res[0])){
            return $res[0]['count'];
        }
        return false;
    }

    public function htmlspecialcharsParams($params){
        $res = array();
        foreach($params as $k => $v){
            if(is_array($v)){
                $res[$k] = $this->htmlspecialcharsParams($v);
            }else if(is_string($v)){
                $res[$k] = htmlspecialchars($v,ENT_QUOTES);
            }else{
                die("Wrong Params!");
            }
        }
        return $res;
    }


    public function getOne($fields=array(),$order='ASC',$extra=''){
        $conn = $this->getConnect();
        $res = $conn->getOne($this->tbName,$fields,$order,$extra);
        return $res;
    }

    /**
     * @param array $fields
     * @param string $extra
     * @param bool $isPageNav
     * @return mixed
     */
    public function getList($fields=array(),$extra=" WHERE `deleted`='n' ",$isPageNav=true){
        $conn = $this->getConnect();

        if(empty($fields)){
            $fields = $this->tbFields;
        }

        if($isPageNav){
            $sql = $conn->assembleSelectSQL($this->tbName,$fields,$extra);

            $pa = new Pagination($conn,$sql);
            $res['rows'] = $pa->getRows();
            $res['nav'] = $pa->getNav();
        }else {
            $res['rows'] = $conn->getList($this->tbName,$fields,$extra);
            $res['nav'] = '';
        }
        $res['rows'] = $this->formatList($res['rows']);

        return $res;
    }

    public function delete($conditions,$operator){
        $conn = $this->getConnect();
        $extra = $conn->assembleConditions($conditions,$operator);
        $extra = ' WHERE '.$extra;
        $res = $this->update(array('deleted'=>'y'),$extra);
        return $res;
    }

    function formatList($list){
        return $list;
    }


    /**
     * @param array $params (array(array(),array()...))
     * @param array $fields
     * @return array
     */
    public function getAll($params=array(),$fields=array()){
        $conn = $this->getConnect();

        if(empty($fields)){
            $fields = $this->tbFields;
        }
        $extra = '';
        if(!empty($params)){
            $extra = ' WHERE '.$conn->assembleConditions($params,'AND');
        }

        $sql = $conn->assembleSelectSQL($this->tbName,$fields,$extra);

        $res = $conn->execute_dql($sql);

        return $res;

    }

}