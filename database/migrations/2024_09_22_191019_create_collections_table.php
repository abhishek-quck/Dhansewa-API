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
        Schema::dropIfExists('collections');
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->integer('branch_id');
            $table->string('due');
            $table->string('collected');
            $table->string('total_center');
            $table->string('total_client');
            $table->string('dbc');
            $table->string('disb');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
};
