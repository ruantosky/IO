<?php
function debug($data, $flag = false)
{
    if ($flag) {
        var_dump($data);
    } else {
        echo "==== >>>> : ".$data." \n";
    }
}
// 发送信息
function send($client, $data, $flag = true)
{
    if ($flag) {
        fwrite($client, $data);
    } else {
        $response = "HTTP/1.1 200 OK\r\n";
        $response .= "Content-Type: text/html;charset=UTF-8\r\n";
        $response .= "Connection: keep-alive\r\n";
        $response .= "Content-length: ".strlen($data)."\r\n\r\n";
        $response .= $data;
        fwrite($client, $response);
    }
}


//获取pid
function pidGet($path){
    $string = file_get_contents($path);
    return explode("|",  substr($string, 0 , strlen($string) - 1));
}

//记录pid
function pidPut($data, $path){
    (empty($data)) ? file_put_contents($path, null) : file_put_contents($path, $data.'|', 8) ;
}

function basePath(){
    // __DIR__ 这是获取该文件运行的目录地址
    return __DIR__;
}