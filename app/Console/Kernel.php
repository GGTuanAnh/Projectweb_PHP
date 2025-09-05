<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array<int, class-string<\Illuminate\Console\Command>>
     */
    protected $commands = [
        \App\Console\Commands\ShowDataCommand::class,
        \App\Console\Commands\MigrateDataCommand::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Ví dụ: đồng bộ analytics mỗi giờ
        // $schedule->command('data:migrate --tables=orders,order_items,products')->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
    }
}
