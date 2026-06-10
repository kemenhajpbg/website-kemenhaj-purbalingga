<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hajj_stats', function (Blueprint $table) {
            $table->id();
            $table->date('data_date');
            $table->unsignedInteger('elderly_count')->default(0);
            $table->string('waiting_period')->nullable();
            $table->unsignedInteger('total_registrants')->default(0);
            $table->json('monthly_registrants');
            $table->json('gender');
            $table->json('occupation');
            $table->json('education');
            $table->json('age');
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hajj_stats');
    }
};
