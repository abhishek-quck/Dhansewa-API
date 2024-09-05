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
        Schema::create('enrollment_additionals', function (Blueprint $table) {
            $table->id();
            $table->string('enroll_id');
            $table->string('door_num');
            $table->string('crossing')->nullable();
            $table->string('street')->nullable();
            $table->string('landmark')->nullable();
            $table->string('alt_phone')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('education')->nullable();
            $table->string('religion')->nullable();
            $table->string('category')->nullable();
            $table->string('ifsc')->nullable();
            $table->string('bank')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('account_num')->nullable();
            $table->boolean('is_debit_card')->default(true);
            $table->boolean('is_account_active')->default(true);
            $table->string('nominee')->nullable();
            $table->string('nominee_dob')->nullable();
            $table->string('nominee_relation')->nullable();
            $table->string('nominee_aadhaar')->nullable();
            $table->string('nominee_kyc_type')->nullable();
            $table->string('nominee_kyc')->nullable();
            $table->string('co_applicant')->nullable();
            $table->string('co_applicant_rel')->nullable();
            $table->string('co_applicant_dob')->nullable();
            $table->string('co_applicant_industry_type')->nullable();
            $table->string('co_applicant_job_type')->nullable();
            $table->string('co_applicant_income_freq')->nullable();
            $table->string('member_in_family')->nullable();
            $table->string('mature_in_family')->nullable();
            $table->string('minor_in_family')->nullable();
            $table->string('earning_person_in_family')->nullable();
            $table->string('depend_person_in_family')->nullable();
            $table->string('house_land')->nullable();
            $table->string('house_type')->nullable();
            $table->string('durable_access')->nullable();
            $table->boolean('is_lpg')->default(false);
            $table->string('total_land')->nullable();
            $table->string('allied_activities')->nullable();
            $table->boolean('farmer_category')->default(false);
            $table->string('total_monthly_income')->nullable();
            $table->string('monthly_expenses')->nullable();
            $table->string('type')->nullable();
            $table->string('email')->nullable();
            $table->string('guarantor')->nullable();
            $table->string('pan')->nullable();
            $table->string('loan_request')->nullable();
            $table->string('enrolled_by')->nullable();
            $table->string('group_no')->nullable();
            $table->integer('kyc_document_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollment_additionals');
    }
};
