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
        Schema::create('client_grt', function (Blueprint $table)
        {
            $table->id();
            $table->foreignId('enroll_id')->references('id')->on('enrollments')->cascadeOnDelete();
            $table->string('en_mode');
            $table->timestamp('grt_date');
            $table->text('visit_photo')->nullable();
            $table->text('group_photo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_grt');
    }
};
