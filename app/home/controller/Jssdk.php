<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/8/9
 * Time: 10:02
 */

namespace app\home\controller;

use houdunwang\view\View;
use houdunwang\wechat\Wechat;
use Curl\Curl;
class Jssdk{
    public function index(){
        $time=time();
        $nonceStr=md5(microtime(true));
        $url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        //p($url);
        $jsapiTicket=$this->getTicket();
        $str="jsapi_ticket={$jsapiTicket}&noncestr={$nonceStr}&timestamp={$time}&url={$url}";
        //p($str);exit;
        $signature=sha1($str);
        return View::make()->with(compact('time','signature','nonceStr'));
    }
    public function getTicket(){
        $url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.Wechat::getAccessToken().'&type=jsapi';
        $data = (new Curl())->get($url);
        $data=json_decode($data->response,true);
        //p($data);
        return $data['ticket'];
    }
}