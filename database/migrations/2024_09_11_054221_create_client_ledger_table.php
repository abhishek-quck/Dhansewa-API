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
        Schema::dropIfExists('client_ledger');

        Schema::create('client_ledger', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enroll_id')->references('id')->on('enrollments');
            $table->string('loan_id');
            $table->integer('emi_no');
            $table->date('transaction_date');
            $table->string('pr_due')->default(0);
            $table->string('int_due')->default(0);
            $table->string('total_due');
            $table->string('pr_collected')->default(0);
            $table->string('int_collected')->default(0);
            $table->string('total_collected');
            $table->string('attend')->nullable();
            $table->string('receipt_no')->nullable();
            $table->string('staff_id')->nullable();
            $table->string('other')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_ledger');
    }
};
