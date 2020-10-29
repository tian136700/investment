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

class SendEmailCom extends Command
{

    public $emailArr = [
        '493701289@qq.com'
    ];
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendEmailCom';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '发送可转债信息';

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
        $arr = CommonHelper::getConvertibleBond();
        $num = count($arr['result']['today']);
        if ($num < 1) {
            die;
        }
        $name = '';
        foreach ($arr['result']['today'] as $val) {
            $name .= $val['bndSecuSht'] . ",";
        }
        CommonHelper::sendEmail("重要！今日有{$num}只可转债申购！", $name, $this->emailArr);
    }


}
