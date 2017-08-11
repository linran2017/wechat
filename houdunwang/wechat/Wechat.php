<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/8/7
 * Time: 22:18
 */

namespace houdunwang\wechat;


class Wechat{
    public static function __callStatic($name,$arguments){
        return call_user_func_array([new Base(),$name],$arguments);
    }
}