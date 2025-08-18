<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class modelsstatus extends Model
{
    protected $table = "tb_status";
    protected $primaryKey = "id_status";
    public $timestamps = ['id_status'];
}
