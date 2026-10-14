<?php

namespace Database\Seeders;

use App\Models\Hajj2027Announcement;
use App\Models\Hajj2027Biometric;
use App\Models\Hajj2027District;
use App\Models\Hajj2027Document;
use App\Models\Hajj2027Kloter;
use App\Models\Hajj2027Service;
use App\Models\Hajj2027Stage;
use App\Models\Hajj2027Stat;
use App\Models\Hajj2027Timeline;
use App\Models\Hajj2027Verification;
use App\Models\News;
use Illuminate\Database\Seeder;

class Hajj2027Seeder extends Seeder
{
    public function run(): void
    {
        // 1. Statistik Utama
        if (! Hajj2027Stat::query()->exists()) {
            Hajj2027Stat::query()->create([
                'total_jemaah' => 375,
                'total_kecamatan' => 18,
                'jemaah_pria' => 172,
                'jemaah_wanita' => 203,
                'jemaah_lansia' => 48,
                'total_kloter' => null, // Menunggu Penetapan
                'keterangan' => 'Data alokasi estimasi sementara calon jemaah haji Kabupaten Purbalingga Tahun 1448 H / 2027 M.',
                'is_published' => true,
            ]);
        }

        // 2. Progres Persiapan (8 Tahapan)
        if (! Hajj2027Stage::query()->exists()) {
            $stages = [
                ['nama_tahapan' => 'Verifikasi Data', 'persentase' => 100, 'status' => 'Selesai', 'keterangan' => 'Verifikasi berkas administrasi dan keabsahan porsi calon jemaah.', 'tanggal_update' => '2026-08-20', 'urutan' => 1],
                ['nama_tahapan' => 'Biometrik', 'persentase' => 59, 'status' => 'Sedang Berlangsung', 'keterangan' => 'Perekaman Bio Visa mandiri dan asistensi di kantor Kemenhaj Purbalingga.', 'tanggal_update' => '2026-10-10', 'urutan' => 2],
                ['nama_tahapan' => 'Paspor', 'persentase' => 75, 'status' => 'Sedang Berlangsung', 'keterangan' => 'Pemeriksaan masa berlaku paspor dan pembuatan paspor baru bersama Imigrasi.', 'tanggal_update' => '2026-10-05', 'urutan' => 3],
                ['nama_tahapan' => 'Pemeriksaan Kesehatan', 'persentase' => 25, 'status' => 'Sedang Berlangsung', 'keterangan' => 'Medical check-up tahap 1 untuk penetapan istitha\'ah kesehatan di Puskesmas/RSUD.', 'tanggal_update' => '2026-09-30', 'urutan' => 4],
                ['nama_tahapan' => 'Pelunasan', 'persentase' => 0, 'status' => 'Belum Dimulai', 'keterangan' => 'Menunggu penetapan Keppres BPIH & Bipih 1448 H / 2027 M dari Pemerintah.', 'tanggal_update' => null, 'urutan' => 5],
                ['nama_tahapan' => 'Manasik', 'persentase' => 0, 'status' => 'Belum Dimulai', 'keterangan' => 'Jadwal manasik massal tingkat kecamatan dan kabupaten akan diumumkan.', 'tanggal_update' => null, 'urutan' => 6],
                ['nama_tahapan' => 'Penetapan Kloter', 'persentase' => 0, 'status' => 'Menunggu Penetapan', 'keterangan' => 'Menunggu pengumuman resmi pembagian kelompok terbang dari Kanwil Jateng.', 'tanggal_update' => null, 'urutan' => 7],
                ['nama_tahapan' => 'Keberangkatan', 'persentase' => 0, 'status' => 'Menunggu Penetapan', 'keterangan' => 'Pemberangkatan menuju Asrama Haji Donohudan Solo sesuai jadwal resmi.', 'tanggal_update' => null, 'urutan' => 8],
            ];

            foreach ($stages as $stage) {
                Hajj2027Stage::query()->create($stage + ['aktif' => true]);
            }
        }

        // 3. Rekapitulasi Verifikasi
        if (! Hajj2027Verification::query()->exists()) {
            Hajj2027Verification::query()->create([
                'nama_tahap' => 'Tahap I',
                'total' => 375,
                'siap' => 348,
                'ditunda' => 15,
                'meninggal' => 4,
                'sudah_berhaji_belum_memenuhi' => 8,
                'keterangan' => 'Hasil verifikasi data awal calon jemaah estimasi keberangkatan 2027.',
                'tanggal_update' => '2026-08-30',
                'urutan' => 1,
                'aktif' => true,
            ]);

            Hajj2027Verification::query()->create([
                'nama_tahap' => 'Tahap II',
                'total' => 27,
                'siap' => 22,
                'ditunda' => 4,
                'meninggal' => 0,
                'sudah_berhaji_belum_memenuhi' => 1,
                'keterangan' => 'Verifikasi pengisian kuota cadangan dan usulan penggabungan mahram.',
                'tanggal_update' => '2026-09-28',
                'urutan' => 2,
                'aktif' => true,
            ]);
        }

        // 4. Biometrik
        if (! Hajj2027Biometric::query()->exists()) {
            Hajj2027Biometric::query()->create([
                'target' => 375,
                'sudah_biometrik' => 222,
                'keterangan' => 'Proses perekaman bio visa secara daring mandiri dan layanan jemput bola di aula Kemenhaj Purbalingga.',
                'tanggal_update' => '2026-10-12',
                'aktif' => true,
            ]);
        }

        // 5. Sebaran Kecamatan (18 Kecamatan di Purbalingga, Total = 375)
        if (! Hajj2027District::query()->exists()) {
            $districts = [
                ['nama_kecamatan' => 'Purbalingga', 'jumlah_jemaah' => 38, 'urutan' => 1],
                ['nama_kecamatan' => 'Kalimanah', 'jumlah_jemaah' => 34, 'urutan' => 2],
                ['nama_kecamatan' => 'Kutasari', 'jumlah_jemaah' => 27, 'urutan' => 3],
                ['nama_kecamatan' => 'Bojongsari', 'jumlah_jemaah' => 24, 'urutan' => 4],
                ['nama_kecamatan' => 'Padamara', 'jumlah_jemaah' => 23, 'urutan' => 5],
                ['nama_kecamatan' => 'Mrebet', 'jumlah_jemaah' => 23, 'urutan' => 6],
                ['nama_kecamatan' => 'Bukateja', 'jumlah_jemaah' => 28, 'urutan' => 7],
                ['nama_kecamatan' => 'Bobotsari', 'jumlah_jemaah' => 27, 'urutan' => 8],
                ['nama_kecamatan' => 'Kemangkon', 'jumlah_jemaah' => 22, 'urutan' => 9],
                ['nama_kecamatan' => 'Kaligondang', 'jumlah_jemaah' => 21, 'urutan' => 10],
                ['nama_kecamatan' => 'Karanganyar', 'jumlah_jemaah' => 19, 'urutan' => 11],
                ['nama_kecamatan' => 'Karangmoncol', 'jumlah_jemaah' => 17, 'urutan' => 12],
                ['nama_kecamatan' => 'Kejobong', 'jumlah_jemaah' => 15, 'urutan' => 13],
                ['nama_kecamatan' => 'Kertanegara', 'jumlah_jemaah' => 14, 'urutan' => 14],
                ['nama_kecamatan' => 'Karangreja', 'jumlah_jemaah' => 13, 'urutan' => 15],
                ['nama_kecamatan' => 'Pengadegan', 'jumlah_jemaah' => 13, 'urutan' => 16],
                ['nama_kecamatan' => 'Rembang', 'jumlah_jemaah' => 10, 'urutan' => 17],
                ['nama_kecamatan' => 'Karangjambu', 'jumlah_jemaah' => 8, 'urutan' => 18],
            ];

            foreach ($districts as $d) {
                Hajj2027District::query()->create($d + ['aktif' => true]);
            }
        }

        // 6. Timeline Persiapan
        if (! Hajj2027Timeline::query()->exists()) {
            $timelines = [
                ['nama_tahap' => 'Verifikasi Berkas & Kuota Awal', 'tanggal' => 'Juli - Agustus 2026', 'status' => 'Selesai', 'deskripsi' => 'Pencocokan data porsi dan status kesiapan jemaah haji Kabupaten Purbalingga.', 'urutan' => 1],
                ['nama_tahap' => 'Perekaman Bio Visa & Validasi Paspor', 'tanggal' => 'September - November 2026', 'status' => 'Berlangsung', 'deskripsi' => 'Pengumpulan paspor fisik dan asistensi rekam biometrik aplikasi Bio Visa.', 'urutan' => 2],
                ['nama_tahap' => 'Pemeriksaan Kesehatan & Istitha\'ah', 'tanggal' => 'Desember 2026 - Januari 2027', 'status' => 'Akan Datang', 'deskripsi' => 'Pemeriksaan komprehensif penentu istitha\'ah kesehatan sebelum masa pelunasan.', 'urutan' => 3],
                ['nama_tahap' => 'Pelunasan Biaya Perjalanan Haji (Bipih)', 'tanggal' => 'Februari - Maret 2027', 'status' => 'Akan Datang', 'deskripsi' => 'Pembayaran pelunasan biaya haji pada BPS Bipih yang ditunjuk Pemerintah.', 'urutan' => 4],
                ['nama_tahap' => 'Bimbingan Manasik Haji Kecamatan & Kab.', 'tanggal' => 'Maret - April 2027', 'status' => 'Akan Datang', 'deskripsi' => 'Pelaksanaan bimbingan manasik teori dan praktik tawaf, sa\'i di alun-alun.', 'urutan' => 5],
                ['nama_tahap' => 'Penetapan Kloter & Pembagian Paspor', 'tanggal' => 'April 2027', 'status' => 'Akan Datang', 'deskripsi' => 'Pemberitahuan nomor kloter resmi, jadwal kumpul koper, dan pembagian visa.', 'urutan' => 6],
                ['nama_tahap' => 'Pelepasan & Keberangkatan Jemaah', 'tanggal' => 'Mei 2027 (1448 H)', 'status' => 'Akan Datang', 'deskripsi' => 'Upacara pelepasan resmi dari Pendopo Dipokusumo menuju Donohudan Solo.', 'urutan' => 7],
            ];

            foreach ($timelines as $t) {
                Hajj2027Timeline::query()->create($t + ['aktif' => true]);
            }
        }

        // 7. Kloter (Belum Ditetapkan)
        if (! Hajj2027Kloter::query()->exists()) {
            Hajj2027Kloter::query()->create([
                'nomor_kloter' => 'Belum Ditetapkan',
                'jumlah_jemaah' => 0,
                'embarkasi' => 'SOC (Solo)',
                'tanggal_masuk_asrama' => null,
                'tanggal_keberangkatan' => null,
                'status' => 'Belum Ditetapkan',
                'keterangan' => 'Informasi kloter akan diperbarui setelah penetapan resmi oleh Kanwil Kementerian Haji dan Umrah.',
                'urutan' => 1,
                'aktif' => true,
            ]);
        }

        // 8. Layanan Jemaah
        if (! Hajj2027Service::query()->exists()) {
            $services = [
                [
                    'judul' => 'Layanan Khusus Jemaah Lansia',
                    'icon' => 'elderly',
                    'deskripsi' => 'Pendampingan terpadu, penyediaan alat bantu mobilitas, serta penempatan akomodasi yang mudah diakses untuk kenyamanan jemaah lanjut usia.',
                    'urutan' => 1,
                ],
                [
                    'judul' => 'Fasilitas Ramah Disabilitas',
                    'icon' => 'disability',
                    'deskripsi' => 'Asistensi personal dan sarana khusus bagi calon jemaah dengan kebutuhan khusus sejak proses manasik hingga proses embarkasi.',
                    'urutan' => 2,
                ],
                [
                    'judul' => 'Pendampingan & Penggabungan Mahram',
                    'icon' => 'companion',
                    'deskripsi' => 'Layanan konsultasi dan pengajuan penggabungan mahram sah sesuai regulasi pemerintah untuk menjaga keutuhan keluarga.',
                    'urutan' => 3,
                ],
                [
                    'judul' => 'Persiapan Fisik & Kebugaran Terpandu',
                    'icon' => 'health',
                    'deskripsi' => 'Program pembiasaan jalan sehat dan panduan kebugaran bekerja sama dengan Dinas Kesehatan agar jemaah prima saat berhaji.',
                    'urutan' => 4,
                ],
                [
                    'judul' => 'Bimbingan Manasik Haji Komprehensif',
                    'icon' => 'manasik',
                    'deskripsi' => 'Pembekalan fiqih haji praktis dan simulasi lapangan berkelanjutan di KUA kecamatan dan pusat kabupaten.',
                    'urutan' => 5,
                ],
                [
                    'judul' => 'Layanan Informasi & Respons Cepat',
                    'icon' => 'support',
                    'deskripsi' => 'Helpdesk konsultasi langsung di kantor Kemenhaj dan kanal WhatsApp siaga untuk seluruh pertanyaan dan kendala administrasi jemaah.',
                    'urutan' => 6,
                ],
            ];

            foreach ($services as $srv) {
                Hajj2027Service::query()->create($srv + ['aktif' => true]);
            }
        }

        // 9. Pengumuman Haji 2027
        if (! Hajj2027Announcement::query()->exists()) {
            Hajj2027Announcement::query()->create([
                'judul' => 'Jadwal Perekaman Bio Visa Mandiri Calon Jemaah Haji Purbalingga 2027',
                'slug' => 'jadwal-perekaman-bio-visa-mandiri-calon-jemaah-haji-purbalingga-2027',
                'isi' => "Diberitahukan kepada seluruh calon jemaah haji Kabupaten Purbalingga estimasi keberangkatan Tahun 1448 H / 2027 M untuk segera melakukan perekaman biometrik Bio Visa secara mandiri melalui aplikasi Saudi Visa Bio.\n\nBagi calon jemaah yang mengalami kendala teknis (kamera tidak mendeteksi, sidik jari sulit terdeteksi, atau kendala smartphone), Seksi Penyelenggaraan Haji dan Umrah Kemenhaj Purbalingga menyediakan loket asistensi perekaman setiap hari kerja pukul 08.00 - 15.00 WIB di Aula Kantor Kemenhaj Purbalingga.",
                'thumbnail' => null,
                'file_lampiran' => null,
                'tanggal_publikasi' => '2026-10-01',
                'status' => 'Published',
                'urutan' => 1,
            ]);

            Hajj2027Announcement::query()->create([
                'judul' => 'Persiapan Pemeriksaan Kesehatan Tahap I Calon Jemaah Haji 1448 H / 2027 M',
                'slug' => 'persiapan-pemeriksaan-kesehatan-tahap-i-calon-jemaah-haji-1448-h-2027-m',
                'isi' => "Menindaklanjuti pedoman Istitha'ah Kesehatan Haji, seluruh calon jemaah haji 2027 diimbau untuk menjaga kesehatan, mengonsumsi makanan bergizi, serta melakukan pemeriksaan kesehatan rutin di Puskesmas domisili masing-masing.\n\nJadwal resmi medical check up penentu istitha'ah kesehatan terpadu akan dikoordinasikan lebih lanjut bersama Dinas Kesehatan Kabupaten Purbalingga.",
                'thumbnail' => null,
                'file_lampiran' => null,
                'tanggal_publikasi' => '2026-10-08',
                'status' => 'Published',
                'urutan' => 2,
            ]);
        }

        // 10. Dokumen & Panduan
        if (! Hajj2027Document::query()->exists()) {
            Hajj2027Document::query()->create([
                'judul' => 'Buku Saku Panduan Persiapan Calon Jemaah Haji 2027',
                'deskripsi' => 'Panduan lengkap tahapan administrasi, kesehatan, dokumen, dan manasik haji.',
                'kategori' => 'Panduan',
                'file' => 'documents/buku-panduan-jemaah-2027.pdf',
                'file_name' => 'Buku-Panduan-Jemaah-2027.pdf',
                'file_size' => '2.4 MB',
                'tanggal' => '2026-09-15',
                'status' => 'Aktif',
                'urutan' => 1,
            ]);

            Hajj2027Document::query()->create([
                'judul' => 'Petunjuk Teknis Perekaman Bio Visa Mandiri Smartphone',
                'deskripsi' => 'Langkah demi langkah install aplikasi Saudi Visa Bio, scan paspor, wajah, dan 10 sidik jari.',
                'kategori' => 'Panduan',
                'file' => 'documents/juknis-biometrik-bio-visa.pdf',
                'file_name' => 'Juknis-Biometrik-Bio-Visa.pdf',
                'file_size' => '1.1 MB',
                'tanggal' => '2026-09-20',
                'status' => 'Aktif',
                'urutan' => 2,
            ]);

            Hajj2027Document::query()->create([
                'judul' => 'Alur dan Syarat Pemeriksaan Istitha\'ah Kesehatan Haji',
                'deskripsi' => 'Pedoman pemeriksaan kesehatan, tes laboratorium, dan rujukan spesialis jemaah haji.',
                'kategori' => 'Regulasi & Edaran',
                'file' => 'documents/alur-istithaah-kesehatan-haji.pdf',
                'file_name' => 'Alur-Istithaah-Kesehatan-Haji.pdf',
                'file_size' => '850 KB',
                'tanggal' => '2026-10-02',
                'status' => 'Aktif',
                'urutan' => 3,
            ]);

            Hajj2027Document::query()->create([
                'judul' => 'Checklist Berkas Paspor dan Dokumen Keberangkatan Haji',
                'deskripsi' => 'Daftar dokumen fisik yang wajib disiapkan jemaah untuk pembuatan visa dan paspor haji.',
                'kategori' => 'Dokumen & Form',
                'file' => 'documents/checklist-dokumen-haji.pdf',
                'file_name' => 'Checklist-Dokumen-Haji.pdf',
                'file_size' => '420 KB',
                'tanggal' => '2026-10-05',
                'status' => 'Aktif',
                'urutan' => 4,
            ]);
        }

        // 11. Tambahkan berita dengan category 'Haji 2027' jika belum ada
        if (! News::query()->where('category', 'Haji 2027')->exists()) {
            News::query()->create([
                'title' => 'Kemenhaj Purbalingga Akselerasi Perekaman Bio Visa Calon Jemaah Haji 2027',
                'category' => 'Haji 2027',
                'slug' => News::uniqueSlug('Kemenhaj Purbalingga Akselerasi Perekaman Bio Visa Calon Jemaah Haji 2027'),
                'excerpt' => 'Kemenhaj Purbalingga mengimbau dan memfasilitasi 375 calon jemaah haji 2027 untuk menyelesaikan perekaman biometrik.',
                'content' => "PURBALINGGA — Kementerian Haji dan Umrah Kabupaten Purbalingga terus mengakselerasi tahapan persiapan calon jemaah haji untuk keberangkatan Tahun 1448 H / 2027 M.\n\nSalah satu fokus utama saat ini adalah perekaman biometrik Bio Visa mandiri. Melalui layanan asistensi terpadu di Aula Kantor Kemenhaj Purbalingga, petugas siap mendampingi jemaah khususnya kaum lansia agar seluruh data biometrik terverifikasi tepat waktu.\n\nKepala Seksi Penyelenggaraan Haji menyampaikan bahwa sinergi lintas instansi dengan Puskesmas dan Imigrasi juga berjalan intensif demi kelancaran persiapan jemaah Purbalingga menuju Baitullah.",
                'image' => 'images/news/news-1.png',
                'published_at' => now()->subDays(2),
                'is_published' => true,
            ]);
        }
    }
}
