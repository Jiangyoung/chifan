<?php
/**
 * Created by PhpStorm.
 * User: zhangjianying
 * Date: 2015/9/30
 * Time: 14:12
 */
namespace Action\Index;
use Core\Base\Action;
use Dao\Iweb\City;
class Index extends Action{
    public function call(){
        echo '555';
        $s_time = $this->microtime_float_a();
        $obj = new City();
        $e_time = $this->microtime_float_a();
        echo 'new City';
        var_dump($e_time-$s_time);

        $s_time = $this->microtime_float_a();
        $ret = $obj->getAllCity();
        $e_time = $this->microtime_float_a();
        echo 'getAllCity';
        var_dump($e_time-$s_time);
        var_dump($ret);

    }
    public function microtime_float_a(){
        list( $usec ,  $sec ) =  explode ( " " ,  microtime ());
        return ((float) $usec  + (float) $sec );
    }
}