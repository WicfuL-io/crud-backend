<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class modelsviewdata extends Model
{
    protected $table = "tb_cctv";
    protected $primaryKey = "id_cctv";
    protected $fillable = ['title', 'ip_address', 'stream_url'];
    public $timestamps = ['id_cctv'];
}
