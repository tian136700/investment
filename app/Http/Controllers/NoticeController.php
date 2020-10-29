<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Mail;

class NoticeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    public $eamilArr = [
        '493701289@qq.com'
    ];
    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getConvertibleBond()
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
    public function sendEmail()
    {
        $arr = $this->getConvertibleBond();
        $num = count($arr['result']['today']);
        if ($num < 1) {
            die;
        }
        $name = '';
        foreach ($arr['result']['today'] as $val) {
            $name .= $val['bndSecuSht'] . ",";
        }
        Mail::raw($name, function ($message) use ($num) {
            foreach ($this->eamilArr as $value) {
                $message->to($value)->subject("重要！今日有{$num}只可转债申购！！！快点爬起来!!");
            }
        });
        return '发送成功';
    }
}
