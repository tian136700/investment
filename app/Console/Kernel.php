<?php

namespace App\Console;

use App\Console\Commands\SendDiscountCom;
use App\Console\Commands\SendEmailCom;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        SendEmailCom::class,
        SendDiscountCom::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('SendEmailCom')
            ->everyThirtyMinutes()
            ->between('10:00', '11:20');//可转债申购提醒
        $schedule->command('SendEmailCom')
            ->everyThirtyMinutes()
            ->between('13:00', '14:20');//可转债申购提醒
        $schedule->command('SendDiscountCom')
            ->everyMinute();//信用卡优惠提醒
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
