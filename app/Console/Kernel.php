<?php

namespace App\Console;

use App\Cron\CurrencyRates;
use App\Cron\Weather;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Cron\PublicPosts;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->call(function(){
            (new PublicPosts())->run();
        })->daily();

        $schedule->call(function(){
            (new CurrencyRates())->run();
        })->twiceDaily(10, 19);

        $schedule->call(function(){
            (new Weather())->run();
        })->hourly();

        $schedule->command('sitemap:generate')->daily();
        $schedule->command('sitemap_news:generate')->daily();

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
