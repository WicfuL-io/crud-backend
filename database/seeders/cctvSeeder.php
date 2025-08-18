<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class cctvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("tb_cctv")->insert([
            'title'=>'koridor',
            'ip_addres'=>'192.168.1.1',
            'status_id'=> '2'
        ]);

        DB::table('tb_status')->insert([
            'status'=> 'offline',
            'last_offline'=> '12:12:12',
            'last_online'=> '1:1:1',
            'created_at'=> now(),
        ]);
    }
}
