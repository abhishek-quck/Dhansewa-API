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
        Schema::create('center_visits', function (Blueprint $table) {
            $table->id();
            $table->string('branch',100);
            $table->string('center');
            $table->string('address');
            $table->string('field_staff');
            $table->string('meeting_time');
            $table->string('group_leader');
            $table->integer('group_leader_phone',12)->nullable();
            $table->string('active_loan')->nullable();
            $table->string('visiting_officer')->nullable();
            $table->string('visit_time')->nullable();
            $table->string('visit_out_time')->nullable();
            $table->string('visitor_phone')->nullable();
            $table->string('visitor_group')->nullable();
            $table->string('bank_and_others')->nullable();
            $table->string('advance_details')->nullable();
            $table->string('nominee_details')->nullable();
            $table->boolean('credit_report')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('center_visits');
    }
};
