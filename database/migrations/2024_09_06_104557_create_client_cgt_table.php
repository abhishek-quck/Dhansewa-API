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
        Schema::dropIfExists('client_cgt');
        Schema::create('client_cgt', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enroll_id')->references('id')->on('enrollments');
            $table->boolean('revised')->default(false);
            $table->boolean('status')->default(false);
            $table->string('remarks')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_cgt');
    }
};
