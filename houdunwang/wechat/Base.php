<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/8/7
 * Time: 22:29
 */

namespace houdunwang\wechat;
use Curl\Curl;

class Base{
    private $wxObj;
    public function __construct(){
        $this->setWxObj();
    }
    private function setWxObj(){
        if(isset($GLOBALS['HTTP_RAW_POST_DATA'])){
            $wxXML=$GLOBALS['HTTP_RAW_POST_DATA'];
            //2,处理消息类型，把xml格式变为一个对象
            $this->wxObj=simplexml_load_string($wxXML);
        }
    }
    public function validate(){
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce     = $_GET["nonce"];
        $token     =c('wechat.token');
        $tmpArr    = array( $token, $timestamp, $nonce );
        sort( $tmpArr, SORT_STRING );
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
//如果是第一次验证会传入$_GET['echostr']
        if ( $tmpStr == $signature && isset( $_GET['echostr'] ) ) {
            echo $_GET["echostr"];
            exit;
        }
    }
    public function subscribe(){
        if ($this->wxObj->MsgType=='event'){
            if ($this->wxObj->Event=='subscribe'){
                return true;
            }
        }
        return false;
    }

    public function getContent(){
        return strtolower($this->wxObj->Content);
    }
    public function responseMsg($text){
        $FromUserName=$this->wxObj->ToUserName;
        $ToUserName=$this->wxObj->FromUserName;
        $CreateTime=time();
        $MsgType='text';
        $Content=$text;
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
        exit;

    }
    public function  responseNews($data){
        $toUser   = $this->wxObj->FromUserName;
        $fromUser = $this->wxObj->ToUserName;
        $time     = time();
        //文章总数
        $total = count( $data );
        $str = <<<str
<xml>
<ToUserName><![CDATA[{$toUser}]]></ToUserName>
<FromUserName><![CDATA[{$fromUser}]]></FromUserName>
<CreateTime>{$time}</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>{$total}</ArticleCount>
<Articles>
str;
        //组合文章字符串
        foreach ( $data as $v ) {
            $str .= <<<str
<item>
<Title><![CDATA[{$v['title']}]]></Title> 
<Description><![CDATA[{$v['description']}]]></Description>
<PicUrl><![CDATA[{$v['picUrl']}]]></PicUrl>
<Url><![CDATA[{$v['url']}]]></Url>
</item>
str;
        }

        $str .= <<<str
</Articles>
</xml>
str;
        echo $str;
        exit;
    }
    public function getAccessToken() {
        //请求地址
        $url = "https://api.weixin.qq.com/cgi-bin/token";
        //获取access_token填写client_credential
        $grant_type = 'client_credential';
        //第三方用户唯一凭证
        $appid = c( 'wechat.appid' );
        //第三方用户唯一凭证密钥，即appsecret
        $secret = c( 'wechat.appsecret' );
        //最终地址
        $url .= "?grant_type={$grant_type}&appid={$appid}&secret={$secret}";

        //保存accessToken的文件目录
        $path = './storage/data.php';
        //第一次返回为空数组
        $arrToken = include $path;
        if ( ! $arrToken || $arrToken['endtime'] <= time() ) {
            //请求
            $json = file_get_contents( $url );
            //把返回的json转为数组
            $arrToken = json_decode( $json, true );
            //计算过期时间
            $arrToken['endtime'] = time() + 7200;
            //写入到文件保存，为了不用重复的获取access_token，因为获取access_token是每天2000次
            file_put_contents( $path, "<?php return " . var_export( $arrToken, true ) . "?>" );
        }

        return $arrToken['access_token'];


    }
    public function createMenu($data){
        $url='https://api.weixin.qq.com/cgi-bin/menu/create?access_token=' . $this->getAccessToken();
        $json=json_encode($data,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
//        p($json);
        $curl=new Curl();
        $data=$curl->post($url,$json);
        p($data);
        return json_decode($data->response,true);
    }
    public function getMenu(){
        $url='https://api.weixin.qq.com/cgi-bin/menu/get?access_token=' . $this->getAccessToken();
        $curl=new Curl();
        $data=$curl->get($url);
        return json_encode($data->response,true);
    }
    public function removeMenu(){
        $url='https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=' . $this->getAccessToken();
        $curl=new Curl();
        $data=$curl->get($url);
        return json_encode($data->response,true);
    }

    public function getKey(){
        return strtolower($this->wxObj->EventKey);
    }
}