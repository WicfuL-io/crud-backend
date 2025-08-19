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
        $ip = $this->cctv->ip_address;

        Log::info("🔍 Mulai cek CCTV ID: {$this->cctv->id_cctv}, IP: {$ip}");

        $ping = $this->pingWindows($ip);   // gunakan ping Windows
        $newStatus = $ping ? 'ONLINE' : 'OFFLINE';

        // Hanya update kalau status berbeda
        if ($this->cctv->status !== $newStatus) {
            $this->cctv->status = $newStatus;

            if ($newStatus === 'ONLINE') {
                $this->cctv->last_online = now();
                Log::info("✅ CCTV ID: {$this->cctv->id_cctv} berubah ke ONLINE");
            } else {
                $this->cctv->last_offline = now();
                Log::info("❌ CCTV ID: {$this->cctv->id_cctv} berubah ke OFFLINE");
            }

            $this->cctv->save();
        } else {
            Log::info("ℹ CCTV ID: {$this->cctv->id_cctv} masih {$newStatus}, tidak ada perubahan waktu.");
        }

        Log::info("✔ Selesai cek CCTV ID: {$this->cctv->id_cctv}");
    }

    private function pingWindows($ip)
    {
        // -n 1 = ping sekali, -w 1000 = timeout 1 detik
        $command = sprintf('ping -n 1 -w 1000 %s', escapeshellarg($ip));
        $outputText = shell_exec($command);

        // logging debug biar bisa lihat hasil asli dari ping di laravel.log
        Log::debug("📡 Ping Output [{$ip}]: " . $outputText);

        // kalau ada TTL berarti online
        return stripos($outputText, 'TTL') !== false;
    }
}
