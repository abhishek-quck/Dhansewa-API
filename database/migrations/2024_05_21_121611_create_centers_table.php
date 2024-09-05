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
        Schema::create('centers', function (Blueprint $table) {
            $table->id();
            $table->string('branch_id',50)->nullable();
            $table->string('name',100);
            $table->string('local_address',100)->nullable();
            $table->string('district',100)->nullable();
            $table->string('staff',100)->nullable();
            $table->string('meeting_days');
            $table->string('meeting_time');
            $table->string('state',100)->nullable();
            $table->string('village',100)->nullable();
            $table->string('block',20)->nullable();
            $table->string('leader_name',100)->nullable();
            $table->integer('leader_phone')->nullable();
            $table->string('associate_id')->nullable();
            $table->date('formation_date');
            $table->integer('company_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centers');
    }
};
