<?php

namespace App\Helpers;

use App\Http\Controllers\Controller;
use App\Models\Bet;
use App\Models\Config;
use App\Models\Hmember;
use App\Models\Pay;
use App\Models\Time;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Notes:定义公共类
 * Author: Faith
 * Class CommonHelper
 * DateTime: 2020/1/8 10:16
 * Version:1.0
 */
class CommonHelper
{
    public static $eamilArr = [
        '493701289@qq.com'
    ];

    public static function getConvertibleBond()
    {
        $sendUrl = "https://store.gf.com.cn:443/mobileipo/rest/bond/list";
        $headers[] = "Content-type: application/x-www-form-urlencoded";
        $headers[] = "Zoomkey-Auth-Token: 9CD0F0F60AFDF00";
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $sendUrl);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);  // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $tmpInfo = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);
        $arr = json_decode($tmpInfo, true);
        return $arr;
    }

    /**
     * @return string
     */
    public static function sendEmail($title, $content, $emailArr)
    {
        Mail::raw($content, function ($message) use ($title, $emailArr) {
            foreach ($emailArr as $value) {
                $message->to($value)->subject($title);
            }
        });
        return true;
    }
}
