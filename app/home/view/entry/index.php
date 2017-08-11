<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<li><a href="?s=home/wechat/getIp">获取微信服务器的IP</a></li>
<li>
    <form action="" method="get">
        <input type="text" value="<?php echo $content?>" name="content" />
        <input type="submit" value="对话" />
    </form>
    <span><?php p($result) ?></span>
</li>
<li><a href="?s=home/wechat/handleAccessToken">获取access_token测试</a></li>
<li><a href="?s=home/wechat/createMenu">创建菜单</a></li>
<li><a href="?s=home/wechat/getMenu">获取菜单</a></li>
<li><a href="?s=home/wechat/delMenu">删除菜单</a></li>
<li><a href="?s=home/jssdk/index">JSSDK</a></li>
</body>
</html>