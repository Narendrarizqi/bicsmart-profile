<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');                 // contoh: Ketua Tim Peneliti (PI)
            $table->string('expertise')->nullable();    // contoh: Epidemiologi
            $table->string('group', 20)->default('peneliti'); // peneliti | pelaksana
            $table->string('institution')->nullable();
            $table->text('bio')->nullable();
            $table->string('photo')->nullable();
            $table->unsignedSmallInteger('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
