<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/8/4
 * Time: 19:51
 */
/*$signature = $_GET["signature"];
$timestamp = $_GET["timestamp"];
$nonce     = $_GET["nonce"];
$token     = 'wechat';
$tmpArr    = array( $token, $timestamp, $nonce );
sort( $tmpArr, SORT_STRING );
$tmpStr = implode( $tmpArr );
$tmpStr = sha1( $tmpStr );
//如果是第一次验证会传入$_GET['echostr']
if ( $tmpStr == $signature && isset( $_GET['echostr'] ) ) {
    echo $_GET["echostr"];
    exit;
}else{//否则就不是第一次验证了
    //关注回复
    //1,接收微信推送过来的消息（xml格式，字符串类型）
    $wxXML=$GLOBALS['HTTP_RAW_POST_DATA'];
    //2,处理消息类型，把xml格式变为一个对象
    $wxObj=simplexml_load_string($wxXML);
    //如果消息类型为事件event,还有其他类型，比如text
    if (strtolower($wxObj->MsgType)=='event'){
        //关注事件
        if (strtolower($wxObj->Event)=='subscribe'){
            //回复文字
            //刚才是用户发给我们，现在是我们发给用户，所以反一下
            //我们变成发送者FromUserName,用户变为接收者ToUserName
            $FromUserName=$wxObj->ToUserName;
            $ToUserName=$wxObj->FromUserName;
            $CreateTime=time();
            $MsgType='text';
            $Content='欢迎关注“林然”订阅号！';
            $template=<<<str
<xml>
<ToUserName><![CDATA[{$ToUserName}]]></ToUserName>
<FromUserName><![CDATA[{$FromUserName}]]></FromUserName>
<CreateTime>{$CreateTime}</CreateTime>
<MsgType><![CDATA[{$MsgType}]]></MsgType>
<Content><![CDATA[{$Content}]]></Content>
</xml>
str;
            //组合要回复的模板
            echo $template;

        }
    }
}*/
include './vendor/autoload.php';
\houdunwang\core\Boot::run();
?>