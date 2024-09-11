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
            $table->date('emi_no');
            $table->date('transaction_date');
            $table->string('pr_due');
            $table->string('int_due');
            $table->string('total_due');
            $table->string('pr_collected');
            $table->string('int_collected');
            $table->string('total_collected');
            $table->string('attend');
            $table->string('receipt_no');
            $table->string('staff_id');
            $table->string('other');
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
