<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_cctv', function (Blueprint $table) {
            $table->id('id_cctv');
            $table->string('title');
            $table->string('ip_address',15);
            $table->string('stream_url');
            $table->enum('status', ['ONLINE','OFFLINE'])->default('OFFLINE');
            $table->timestamp('last_online')->nullable();
            $table->timestamp('last_offline')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modelsviewdatas');
    }
};
