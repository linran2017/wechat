<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/8/8
 * Time: 19:09
 */

namespace houdunwang\view;


class View{
    public static function __callStatic($name, $arguments){
        return call_user_func_array([new Base(),$name],$arguments);
    }
}