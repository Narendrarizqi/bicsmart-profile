<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('villages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();          // contoh: kedung_randu
            $table->string('code', 5)->unique();       // contoh: KDR
            $table->string('name');                    // contoh: Kedungrandu
            $table->string('district');                // kecamatan, contoh: Patikraja
            $table->text('description')->nullable();
            $table->unsignedSmallInteger('order_index')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('villages');
    }
};
