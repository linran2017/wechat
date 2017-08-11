<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
    <script>
        wx.config({
            debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
            appId: 'wxa87244dd1564d238', // 必填，公众号的唯一标识
            timestamp: '<?php echo $time ?>' , // 必填，生成签名的时间戳
            nonceStr: '<?php echo $nonceStr ?>', // 必填，生成签名的随机串
            signature: '<?php echo $signature ?>',// 必填，签名，见附录1
            jsApiList: ['onMenuShareTimeline','chooseImage','getLocation','startRecord'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
        });
        wx.ready(function(){
            wx.onMenuShareTimeline({
                title: '分享朋友圈', // 分享标题
                link: 'https://github.com/liran2017/stu.git', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                imgUrl: '', // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                    alert('分享成功了');
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                    alert('没有分享到朋友圈');
                }
            });
        });
        function choose() {
            wx.chooseImage({
                count: 1, // 默认9
                sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
                sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
                success: function (res) {
                    var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                }
            });
        }
        function getAddess() {
            wx.getLocation({
                type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
                success: function (res) {
                    var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                    var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                    var speed = res.speed; // 速度，以米/每秒计
                    var accuracy = res.accuracy; // 位置精度
                }
            });
        }
    </script>
</head>
<body>
3333
<li><a href="javascript:choose();">选择相册</a></li>
<li><a href="javascript:getAddess();">获取地理位置</a></li>
</body>
</html>