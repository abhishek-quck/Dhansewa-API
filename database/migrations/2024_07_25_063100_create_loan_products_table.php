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
        Schema::create('loan_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('emi_frequency')->nullable();
            $table->string('product_type')->nullable();
            $table->string('flat_rate')->nullable();
            $table->string('reducing')->nullable();
            $table->string('gst_tax')->nullable();
            $table->string('risk_fund')->nullable();
            $table->integer('installments');
            $table->integer('amount')->nullable();
            $table->string('up_front_fee');
            $table->string('cb_check');
            $table->string('linked_ac_number');
            $table->string('reducing_rate');
            $table->string('category');
            $table->string('repay_pattern');
            $table->string('month_tenure');
            $table->string('year_tenure');
            $table->date('intro_date')->nullable();
            $table->date('removal_date')->nullable();
            $table->text('comments');
            $table->timestamps();
        });
    }













    /**
     *
     *
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_products');
    }
};
