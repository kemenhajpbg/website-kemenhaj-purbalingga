<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Statistik Utama Jemaah 2027
        Schema::create('hajj_2027_stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('total_jemaah')->nullable();
            $table->unsignedInteger('total_kecamatan')->nullable();
            $table->unsignedInteger('jemaah_pria')->nullable();
            $table->unsignedInteger('jemaah_wanita')->nullable();
            $table->unsignedInteger('jemaah_lansia')->nullable();
            $table->unsignedInteger('total_kloter')->nullable();
            $table->text('keterangan')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        // 2. Progres Persiapan Haji 2027 (8 Tahapan)
        Schema::create('hajj_2027_stages', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tahapan');
            $table->unsignedTinyInteger('persentase')->default(0); // 0-100
            $table->string('status')->default('Belum Dimulai'); // Belum Dimulai, Sedang Berlangsung, Selesai, Menunggu Penetapan
            $table->text('keterangan')->nullable();
            $table->date('tanggal_update')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });

        // 3. Rekapitulasi Verifikasi Calon Jemaah (Tahap I, Tahap II, dst.)
        Schema::create('hajj_2027_verifications', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tahap');
            $table->unsignedInteger('total')->default(0);
            $table->unsignedInteger('siap')->default(0);
            $table->unsignedInteger('ditunda')->default(0);
            $table->unsignedInteger('meninggal')->default(0);
            $table->unsignedInteger('sudah_berhaji_belum_memenuhi')->default(0);
            $table->text('keterangan')->nullable();
            $table->date('tanggal_update')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });

        // 4. Progres Biometrik Jemaah Haji 2027
        Schema::create('hajj_2027_biometrics', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('target')->default(0);
            $table->unsignedInteger('sudah_biometrik')->default(0);
            $table->text('keterangan')->nullable();
            $table->date('tanggal_update')->nullable();
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });

        // 5. Sebaran Calon Jemaah Haji per Kecamatan
        Schema::create('hajj_2027_districts', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kecamatan');
            $table->unsignedInteger('jumlah_jemaah')->default(0);
            $table->integer('urutan')->default(0);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });

        // 6. Timeline Persiapan Jemaah Haji 2027
        Schema::create('hajj_2027_timelines', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tahap');
            $table->string('tanggal');
            $table->string('status')->default('Akan Datang'); // Selesai, Berlangsung, Akan Datang
            $table->text('deskripsi')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });

        // 7. Informasi Kloter Jemaah Haji Purbalingga
        Schema::create('hajj_2027_kloters', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kloter');
            $table->unsignedInteger('jumlah_jemaah')->default(0);
            $table->string('embarkasi')->nullable();
            $table->dateTime('tanggal_masuk_asrama')->nullable();
            $table->dateTime('tanggal_keberangkatan')->nullable();
            $table->string('status')->default('Belum Ditetapkan'); // Belum Ditetapkan, Terjadwal, Sudah Berangkat, Dalam Perjalanan, Sudah Tiba, Selesai
            $table->text('keterangan')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });

        // 8. Prioritas Layanan Jemaah
        Schema::create('hajj_2027_services', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('icon')->nullable();
            $table->text('deskripsi');
            $table->integer('urutan')->default(0);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });

        // 9. Pengumuman Haji 2027
        Schema::create('hajj_2027_announcements', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->longText('isi');
            $table->string('thumbnail')->nullable();
            $table->string('file_lampiran')->nullable();
            $table->date('tanggal_publikasi')->nullable();
            $table->string('status')->default('Published'); // Draft, Published
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        // 10. Panduan & Dokumen Jemaah
        Schema::create('hajj_2027_documents', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('kategori')->default('Panduan');
            $table->string('file');
            $table->string('file_name')->nullable();
            $table->string('file_size')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('status')->default('Aktif'); // Aktif, Nonaktif
            $table->integer('urutan')->default(0);
            $table->unsignedInteger('download_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hajj_2027_documents');
        Schema::dropIfExists('hajj_2027_announcements');
        Schema::dropIfExists('hajj_2027_services');
        Schema::dropIfExists('hajj_2027_kloters');
        Schema::dropIfExists('hajj_2027_timelines');
        Schema::dropIfExists('hajj_2027_districts');
        Schema::dropIfExists('hajj_2027_biometrics');
        Schema::dropIfExists('hajj_2027_verifications');
        Schema::dropIfExists('hajj_2027_stages');
        Schema::dropIfExists('hajj_2027_stats');
    }
};
