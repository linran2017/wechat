<?php
function p($var){
    echo '<pre style="background: #ccc; font-size: 16px; padding: 5px">';
    print_r($var);
    echo '</pre>';
}
//wechat.token
function c($path){
    $arr=explode('.',$path);
    $config=include './system/config/'.$arr[0].'.php';
    return isset($config[$arr[1]])?$config[$arr[1]]:NULL;
}