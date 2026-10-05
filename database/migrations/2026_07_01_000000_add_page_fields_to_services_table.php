<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('type', 20)->default('link')->after('id'); // 'link' or 'page'
            $table->string('slug')->nullable()->unique()->after('title');
            $table->text('description')->nullable()->after('slug');

            // Data Total Jemaah Haji
            $table->unsignedInteger('total_verified')->default(0)->after('description');
            $table->unsignedInteger('ready_count')->default(0)->after('total_verified');
            $table->unsignedInteger('delayed_count')->default(0)->after('ready_count');
            $table->unsignedInteger('deceased_count')->default(0)->after('delayed_count');
            $table->unsignedInteger('under_18_count')->default(0)->after('deceased_count');
            $table->unsignedInteger('transfer_count')->default(0)->after('under_18_count');
            $table->json('district_counts')->nullable()->after('transfer_count');

            // Dokumen PDF
            $table->string('document_path')->nullable()->after('district_counts');
            $table->string('document_name')->nullable()->after('document_path');
            $table->string('document_size', 50)->nullable()->after('document_name');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'type',
                'slug',
                'description',
                'total_verified',
                'ready_count',
                'delayed_count',
                'deceased_count',
                'under_18_count',
                'transfer_count',
                'district_counts',
                'document_path',
                'document_name',
                'document_size',
            ]);
        });
    }
};
