<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\CheckAllCCTV::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        // Tambahkan log untuk memeriksa scheduler dipanggil
        Log::info('Scheduler Laravel dijalankan');

        // Jalankan CheckAllCCTV tiap menit (testing)
        $schedule->command('cctv:check-all')->everyMinute();
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }
}
