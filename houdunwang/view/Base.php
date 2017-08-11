<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/8/8
 * Time: 19:14
 */

namespace houdunwang\view;


class Base{
    private $tpl;
    private $val=[];
    public function make(){
        $this->tpl='./app/'.APP.'/view/'.CONTROLLER.'/'.ACTION.'.php';
        return $this;
    }
    public function with($data){
        $this->val=$data;
        return $this;
    }
    public function __toString(){
        extract($this->val);
        include $this->tpl;

        return '';
    }
}