<?php

namespace App\Http\Controllers\Backend;

use App\Exceptions\ApiException;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\JWTException;

class TestController extends Controller
{
    public function pushTest(Request $request)
    {
        //接收表单数据
        $user = 'lx080500';
        $pass = 'jsjsjjs';
        $phone = '15722948127';
        $address = 'China';
        $date = date('H:i,S H Y');
        $DOCUMENT_ROOT = 'D:\soft\test';

        echo '用户：'.$user.'<br>密码：'.$pass.'<br>手机：'.$phone.'<br>地址：'.$address.'<br>日期：'.$date.'<br>路径：'.$DOCUMENT_ROOT;

        //将数据写入file文件3步骤:创建打开--写入数据--保存关闭
        //1.打开文件并选择模式（只读、只写、读写）
//        dd("__FILE__:  ========>  ".__FILE__  );
        $fp = fopen("D:/laravel54/laravel54/public/src/data/reg.txt",'ab');
        if(!$fp){
            echo 'error!';
            exit;
        }
        //写入数据
        $outputstring = $user.$pass.$phone.$address.$date."\n";
        fwrite($fp,$outputstring,strlen($outputstring));
        flock($fp,LOCK_UN);
        fclose($fp);
        echo '<br>数据写入成功<br>';

        //读文件
        $fp = fopen("D:/laravel54/laravel54/public/src/data/reg.txt",'rb');
        if(!$fp){
            echo 'error!';
            exit;
        }
        while(!feof($fp)){
            $order = fgets($fp,999);
            echo $order."<br>";
        }

    }
}
