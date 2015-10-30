<?php
/**
 * Created by PhpStorm.
 * User: zhangjianying
 * Date: 2015/9/30
 * Time: 16:06
 */
namespace Common\Base;

use Common\Conf;

class MysqliDao
{
    protected $_conn;
    final function __construct(){
        $dbConfig = Conf::getConf('public/db','iweb');
        if(empty($dbConfig)){
            exit("Fatal: config file exists!");
        }
        $this->_conn = new \mysqli($dbConfig['host'],$dbConfig['user'],$dbConfig['passwd'],$dbConfig['dbname']);

        if(mysqli_connect_errno()){
            printf ( "Connect failed: %s\n" , mysqli_connect_error());
            exit();
        }
        if (! $this->_conn -> set_charset ( "utf8" )) {
            printf ( "Error loading character set utf8: %s\n" ,  $this->conn -> error );
            exit();
        }
        $this->init();
    }
    private function init(){

    }
    /**
     * 基础查询操作
     * @param String $sql  SQL查询语句
     * @param Array $order  排序方式  'field'=>'DESC/ASC'
     * @param Array/Integer $limit  区间 array(start,offset)  array(0,offset)直接写offset
     * @return array
     */
    function execute_dql($sql)
    {
        echo $sql,'<hr/>';

        $queryRes = $this->_query($sql);
        $res = array();
        if($queryRes){
            while($row = $queryRes->fetch_assoc()){
                $res[] = $row;
            }
        }
        $queryRes->close();
        return $res;
    }

    public function microtime_float_a(){
        list( $usec ,  $sec ) =  explode ( " " ,  microtime ());
        return ((float) $usec  + (float) $sec );
    }

    /**
     * 基础更新操作
     * @param $sql
     * @return bool|\mysqli_result
     */
    function execute_dml($sql)
    {
        //echo $sql,'<hr/>';
        $res = $this->_query($sql);
        return $res;
    }

    /**
     * @param $sql
     * @return bool|\mysqli_result
     */
    protected function _query($sql){
        return $this->_conn->query($sql);
    }

    public function __destruct(){
        echo 1;
        $this->_conn->close();
    }
}