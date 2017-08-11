<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/8/8
 * Time: 9:28
 */

namespace app\home\controller;
use Curl\Curl;
use houdunwang\wechat\Wechat as Wx;
class Wechat{
    public function handel(){
        Wx::validate();
        if (Wx::subscribe()){
            Wx::responseMsg('订阅成功');
        }
        $data=[
            [
                'title'       => '快速调试Vue的利器-devtools',
                'description' => '操作VUE的插件，非常好用',
                'picUrl'      => 'http://wx.nickblog.cn/resource/images/vue.png',
                'url'         => 'http://www.nickblog.cn/article/2306.html'
            ],
            [
                'title'       => 'mac安装composer',
                'description' => '苹果系统如何安装composer',
                'picUrl'      => 'http://wx.nickblog.cn/resource/images/xiaotu.jpeg',
                'url'         => 'http://www.nickblog.cn/article/2277.html'
            ],
            [
                'title'       => 'phpstorm支持es6的语法',
                'description' => 'es6的语法，增加了很多新特性',
                'picUrl'      => 'http://wx.nickblog.cn/resource/images/xiaotu2.jpg',
                'url'         => 'http://www.nickblog.cn/article/2232.html'
            ]
        ];[
            [
                'title'       => '快速调试Vue的利器-devtools',
                'description' => '操作VUE的插件，非常好用',
                'picUrl'      => 'http://wx.nickblog.cn/resource/images/vue.png',
                'url'         => 'http://www.nickblog.cn/article/2306.html'
            ],
            [
                'title'       => 'mac安装composer',
                'description' => '苹果系统如何安装composer',
                'picUrl'      => 'http://wx.nickblog.cn/resource/images/xiaotu.jpeg',
                'url'         => 'http://www.nickblog.cn/article/2277.html'
            ],
            [
                'title'       => 'phpstorm支持es6的语法',
                'description' => 'es6的语法，增加了很多新特性',
                'picUrl'      => 'http://wx.nickblog.cn/resource/images/xiaotu2.jpg',
                'url'         => 'http://www.nickblog.cn/article/2232.html'
            ]
        ];
        switch (Wx::getContent()){
         case 1;
         Wx::responseMsg('您好');
         case 2;
         Wx::responseMsg('美女');
         case '技术文章';

         Wx::responseNews($data);
        }
        switch (Wx::getKey()){
            case 'msg';
            Wx::responseNews($data);
            case 'frame';
            Wx::responseMsg('https://github.com/liran2017/stu.git');
        }
        Wx::responseMsg($this->getTuling(Wx::getContent()));
    }
    public function getTuling( $content = '北京天气' ) {
        $url = "http://www.tuling123.com/openapi/api?key=8fd4b055a27744579fbb1e4e594d7c61&info=" . $content;
        //curl方式请求，不要用file_get_contents，比较low
        $curl = new Curl();
        $data = $curl->get( $url );
        $arr  = json_decode( $data->response, true );

        //echo $arr['text'];
        return $arr['text'];
    }

    public function handleAccessToken(){
        $accessToken=Wx::getAccessToken();
        echo $accessToken;
    }
    public function getIp(){
        $url = "https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=";
        $url .= Wx::getAccessToken();
        //调取接口
        $data = file_get_contents($url);
        $data = json_decode($data);
        //输出ip地址，微信服务器很多ip地址
        foreach ($data->ip_list as $ip) {
            echo $ip . '<br/>';
        }
    }
    public function createMenu(){
        $data = [
            'button' => [
                [
                    "type" => "click",
                    "name" => "留言板",
                    "key"  => "msg"
                ],
                [
                    "type" => "click",
                    "name" => "自己的框架",
                    "key"  => "frame"
                ],
                [
                    "name"       => "我的项目",
                    "sub_button" => [
                        [
                            "type" => "view",
                            "name" => "淘宝移动端",
                            "url"  => "http://www.linran136.com/mtb/web/index.html"
                        ],
                        [
                            "type" => "view",
                            "name" => "豆瓣网首页",
                            "url"  => "http://www.linran136.com/doban/web/index.html"
                        ],
                        [
                            "type" => "view",
                            "name" => "学生管理系统",
                            "url"  => "http://www.linran136.com/student/public/index.php"
                        ],
                        [
                            "type" => "view",
                            "name" => "留言板",
                            "url"  => "http://www.linran136.com/lyb/public/index.php"
                        ],
                        [
                            "type" => "view",
                            "name" => "微信jssdk",
                            "url"  => "http://wechat.linran136.com/?s=home/jssdk/index"
                        ]
                    ]
                ]

            ]
        ];
        $rel=Wx::createMenu($data);
        p($rel);
    }
    public function getMenu(){
        $data=Wx::getMenu();
        p($data);
    }
    public function delMenu(){
        $rel=Wx::removeMenu();
        p($rel);
    }
}