<?php
/**
 * Created by PhpStorm.
 * User: ruantofly
 * Date: 2020/3/11
 * Time: 15:57
 */

$son = pcntl_fork();

$son1 = pcntl_fork();

    if($son>0){
        echo "fu";
    }else{
        echo 'zi';
       // break;
    }

//for($i=0;$i<2;$i++){
//    $son = pcntl_fork();
//    if($son>0){
//        echo "fu";
//    }else{
//        echo 'zi';
//        break;
//    }
//
//
//}

while(true){}
