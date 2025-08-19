<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CCTV extends Model
{
    protected $table = 'tb_cctv';
    protected $primaryKey = 'id_cctv';

    protected $fillable = [
        'title',
        'ip_address', 
        'stream_url',
        'status',
        'last_online',
        'last_offline'
    ];
}
