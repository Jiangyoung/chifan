<?php
/**
 * Created by PhpStorm.
 * User: zhangjianying
 * Date: 2015/9/30
 * Time: 14:17
 */
namespace Controller;
use \Core\Base\Controller;
class Index extends Controller{
    public $actions = array(
        'index' => '\\Action\\Index\\Index'
    );
}