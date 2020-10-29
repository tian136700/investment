<?php

namespace App\Console\Commands;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Qhb5\FrontController;
use App\Jobs\SendCaijin;
use App\Models\Caijin\Caijin;
use App\Models\Caijin\CaijinStatus;
use App\Models\Process;
use App\Models\Qhb\RedOrder;
use App\Models\Qhb5\Other;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class SendDiscountCom extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendDiscountCom';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '发送信用卡优惠';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $time = date('Y-m-d H:i:s');
        $title = '';
        $content = '';
        switch ($time) {
            case $time > date('Y-m-d 23:55:30') && $time <= date('Y-m-d 23:59:30'):
                $title = '1.中信正道4张；2.工行积分兑；3.广发-苏州-饭票-买菜';
                $content = '0点，中信信用卡，动卡空间APP，精彩365，定位郑州，天天友券
1.正道44抵50券，1户4张。每单返45
上传链接https://www.bettercard.cn/wesell/?channel=normal&redirect=/jfsl/pages/trade/detail?id=1112
2.酒便利88抵100券，1户2张。每单返92
上传链接https://www.bettercard.cn/wesell/?channel=normal&redirect=/jfsl/pages/trade/detail?id=1510
3.王府井90抵100，一户2张，92收
上传链接https://www.bettercard.cn/wesell/?channel=normal&redirect=/jfsl/pages/trade/detail?id=1553
4.小飞象88抵100,91.5收
上传链接https://www.bettercard.cn/wesell/?channel=normal&redirect=/jfsl/pages/trade/detail?id=918'
                    . '广发发现精彩app，定位苏州，饭票，搜买菜，积分兑换 
 24收叮咚买菜30元礼品卡
截图➕复制券码
上传链接https://www.bettercard.cn/wesell/?channel=normal&redirect=/jfsl/pages/trade/detail?id=1555';
                break;
            case $time > date('Y-m-d 10:55:30') && $time <= date('Y-m-d 10:59:30'):
                $title = '1.广发-饭票-呷哺35买；';
                $content = '广发发现精彩app，定位苏州，饭票，搜买菜，积分兑换 
 24收叮咚买菜30元礼品卡
截图➕复制券码
上传链接https://www.bettercard.cn/wesell/?channel=normal&redirect=/jfsl/pages/trade/detail?id=1555';
                break;
            case $time > date('Y-m-01 8:55:30') && $time <= date('Y-m-01 8:59:30'):
                $title = '1.交通-支付宝-丰水果';
                $content = '交行口碑4.5元毛，每月一次。9点开始
支付宝里口碑定位合肥，搜鲜丰水果 ，或者直接扫码直达 
买20元西瓜，领10元交通银行信用卡消费券，领到买单，
选交行信用卡-10 ，实付10反14.5 交单：券码➕截图
上传链接https://www.bettercard.cn/wesell/?channel=normal&redirect=/jfsl/pages/trade/detail?id=1508';
                break;
            default:
                die;
        }
        CommonHelper::sendEmail($title, $content, CommonHelper::$eamilArr);
    }


}
