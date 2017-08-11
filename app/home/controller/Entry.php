<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/8/7
 * Time: 20:40
 */

namespace app\home\controller;


use houdunwang\view\View;

class Entry{
    public function index(){
        $content=isset($_GET['content'])?$_GET['content']:'北京天气';
        $result=(new Wechat())->getTuling($content);
       return  View::make()->with(compact('content','result'));

    }
}