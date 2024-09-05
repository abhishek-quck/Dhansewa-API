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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('full_address')->nullable();
            $table->string('ob_type')->nullable();
            $table->dateTime('ob_date')->nullable();
            $table->string('ob_balance')->nullable();
            $table->string('ob_head')->nullable();
            $table->integer('ob_head_id')->nullable();
            $table->string('prefix')->nullable();
            $table->string('key_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
