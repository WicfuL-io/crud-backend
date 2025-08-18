<?php

namespace App\Jobs;

use App\Models\CCTV;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CheckCCTVStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $cctv;

    public function __construct(CCTV $cctv)
    {
        $this->cctv = $cctv;
    }

    public function handle()
    {
        $ip = $this->cctv->ip_address; // PERBAIKAN typo

        Log::info("Job CheckCCTVStatus mulai untuk CCTV ID: {$this->cctv->id_cctv}, IP: {$ip}");

        $ping = $this->ping($ip);

        if ($ping) {
            $this->cctv->status = 'ONLINE';
            $this->cctv->last_online = now();
            Log::info("CCTV ID: {$this->cctv->id_cctv} ONLINE");
        } else {
            $this->cctv->status = 'OFFLINE';
            $this->cctv->last_offline = now();
            Log::info("CCTV ID: {$this->cctv->id_cctv} OFFLINE");
        }

        $this->cctv->save();
        Log::info("Job CheckCCTVStatus selesai untuk CCTV ID: {$this->cctv->id_cctv}");
    }

    private function ping($ip)
    {
        // Ping cross-platform
        $pingresult = exec(sprintf('ping -n 1 -w 1 %s', escapeshellarg($ip)));
        return (stripos($pingresult, 'TTL') !== false);
    }
}
