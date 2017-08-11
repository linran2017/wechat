<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/8/7
 * Time: 20:12
 */

namespace houdunwang\core;


class Boot{
    public static function run(){
        self::init();
        self::appRun();
    }
    private static function appRun(){
        $s=isset($_GET['s'])?strtolower($_GET['s']):'home/entry/index';
        $arr=explode('/',$s);
        define('APP',$arr[0]);
        define('CONTROLLER',$arr[1]);
        define('ACTION',$arr[2]);
        $className="\app\\{$arr[0]}\\controller\\".ucfirst($arr[1]);
        echo call_user_func([new $className,$arr[2]],[]);
    }
    private static function init(){
        session_id() || session_start();
        date_default_timezone_set('PRC');
        define('IS_POST',$_SERVER['REQUEST_METHOD']=='POST'?true:false);
    }
}