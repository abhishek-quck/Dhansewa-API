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
        Schema::create('sidebar-submenu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->references('id')->on('enrollments');
            $table->string('title');
            $table->string('icon');
            $table->string('href');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sidebar-submenu');
    }
};
