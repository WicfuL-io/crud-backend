<?php

namespace App\Console;

use App\Jobs\CheckCCTVStatus;
use App\Models\CCTV;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Kernel
{
    public function __invoke(){
        $cctvs = CCTV::all();
        foreach ($cctvs as $cctv) {
            Log::info("Dispatch job untuk CCTV ID: {$cctv->id_cctv}, IP: {$cctv->ip_address}");
            CheckCCTVStatus::dispatch($cctv);
        }
        Log::info('CheckAllCCTV selesai dispatch semua CCTV');
    }
}
