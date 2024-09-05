<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->string('branch_id',70);
            $table->string('center_id',20);
            $table->string('aadhaar',50);
            $table->string('verification_type',100);
            $table->string('verification',100);
            $table->string('applicant_name',100);
            $table->string('relation',50);
            $table->string('relative_name',100)->nullable();
            $table->string('gender',30);
            $table->string('PAN',30);
            $table->string('postal_pin',20);
            $table->string('village',100);
            $table->string('district',100);
            $table->string('state',100);
            $table->string('date_of_birth',50);
            $table->string('phone',20);
            $table->string('group')->nullable();
            $table->boolean('advance_details')->default(0)->nullable();
            $table->boolean('nominee_details')->default(0)->nullable();
            $table->boolean('credit_report')->default(0)->nullable();
            $table->boolean('review')->default(0)->nullable();
            $table->boolean('sent_back')->default(0)->nullable();
            $table->boolean('approved')->default(0)->nullable();
            $table->string('company_id');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE enrollments AUTO_INCREMENT = 1000;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
