<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CCTV;
use App\Jobs\CheckCCTVStatus;
use Illuminate\Support\Facades\Log;

class CheckAllCCTV extends Command
{
    protected $signature = 'cctv:check-all';
    protected $description = 'Cek status semua CCTV';

    public function handle()
    {
        Log::info('Command CheckAllCCTV dipanggil oleh scheduler');

        $cctvs = CCTV::all();
        foreach ($cctvs as $cctv) {
            Log::info("Dispatch job untuk CCTV ID: {$cctv->id_cctv}, IP: {$cctv->ip_address}");
            CheckCCTVStatus::dispatch($cctv);
        }

        $this->info('Semua CCTV telah dijadwalkan untuk dicek statusnya.');
        Log::info('CheckAllCCTV selesai dispatch semua CCTV');
    }
}
