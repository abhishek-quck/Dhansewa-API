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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('emp_type')->nullable();
            $table->string('designation')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->unique();
            $table->string('branch')->nullable();
            $table->string('access_branch')->nullable();
            $table->string('address')->nullable();
            $table->string('login_id')->unique();
            $table->string('password')->nullable();
            $table->string('married')->nullable();
            $table->string('gender')->nullable();
            $table->string('motorization')->nullable();
            $table->string('dashboard')->nullable();
            $table->string('approval_limit')->nullable();
            $table->string('dob')->nullable();
            $table->string('app_login')->nullable();
            $table->string('exit_date')->nullable();
            $table->string('join_date')->nullable();
            $table->string('email')->unique();
            $table->string('pan')->nullable();
            $table->string('aadhaar')->unique();
            $table->string('bank')->nullable();
            $table->string('bank_branch')->nullable();
            $table->integer('cID')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
