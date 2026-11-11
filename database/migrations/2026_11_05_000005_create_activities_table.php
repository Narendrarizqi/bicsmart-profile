<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Dokumentasi kegiatan harian.
     */
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->date('activity_date');
            $table->string('category', 30); // wp1 | wp3 | sosialisasi | pelatihan | rapat
            $table->foreignId('village_id')->nullable()->constrained()->nullOnDelete();
            $table->string('location')->nullable(); // lokasi bebas jika bukan desa mitra
            $table->text('description');
            $table->json('photos')->nullable();
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status', 20)->default('draft'); // draft | published
            $table->timestamps();
            $table->index(['status', 'activity_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
