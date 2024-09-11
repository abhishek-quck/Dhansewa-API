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
        Schema::create('loan_disbursements', function (Blueprint $table) {
            $table->id();
            $table->integer('enroll_id');
            $table->string('loan_id');
            $table->date('loan_date');
            $table->integer('loan_amount')->nullable();
            $table->integer('loan_fee')->nullable();
            $table->integer('insurance_fee')->nullable();
            $table->integer('gst')->nullable();
            $table->string('loan_product_id')->nullable();
            $table->string('funding_by')->nullable();
            $table->string('policy')->nullable();
            $table->string('utilization')->nullable();
            $table->date('first_installment')->nullable();
            $table->integer('number_of_emis')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('self_income')->default(0);
            $table->string('husband_income')->default(0);
            $table->string('other_income')->default(0);
            $table->string('total_income')->default(0);
            $table->string('direct_income')->default(0);
            $table->string('business_expense')->default(0);
            $table->string('household_expense')->default(0);
            $table->string('loan_installment')->default(0);
            $table->string('total_expense')->default(0);
            $table->foreign('enroll_id')->references('id')->on('enrollments');
            $table->boolean('completed')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_disbursements');
    }
};
