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
        Schema::create('client_loans', function (Blueprint $table) {
            $table->foreignId('enroll_id')->references('id')->on('enrollments');
            $table->foreignId('loan_id')->references('loan_id')->on('loan_disbursements');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_loans');
    }
};
