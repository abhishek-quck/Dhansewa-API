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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('branch_manager_id');
            $table->string('gps_location');
            $table->string('state_code');
            $table->integer('branch_gst_num');
            $table->string('payout_month_and_year')->nullable();
            $table->date('setup_date');
            $table->boolean('backdate_allowed')->default(false);
            $table->date('running_date');
            $table->date('dissolved_date')->nullable();
            $table->boolean('multi_loan_allowed')->default(false);
            $table->boolean('spml_allowed')->default(false);
            $table->string('loan_product_id')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('cash_account')->nullable();
            $table->string('branch_account')->nullable();
            $table->boolean('loan_charge_auto')->default(false);
            $table->string('cash_balance')->default(0);
            $table->boolean('closing_enabled')->default(false);
            $table->string('reporting_mail')->nullable();
            $table->boolean('aadhaar_verify')->default(false);
            $table->string('reporting_phone_sms')->nullable();
            $table->boolean('mobile_verify')->default(false);
            $table->integer('company_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
