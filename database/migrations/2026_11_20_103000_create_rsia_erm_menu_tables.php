<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateRsiaErmMenuTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. Master Menu
        if (!Schema::hasTable('rsia_erm_menu')) {
            Schema::create('rsia_erm_menu', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nama_menu', 100);
                $table->string('url', 255);
                $table->string('icon', 50)->default('bi-circle');
                $table->string('icon_bg', 50)->default('icon-poli');
                $table->string('kategori', 100)->default('Pelayanan Pasien');
                $table->integer('urutan')->default(1);
                $table->string('target', 20)->default('_self');
                $table->string('title', 255)->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // 2. Akses per Departemen / Profesi / All
        if (!Schema::hasTable('rsia_erm_menu_akses')) {
            Schema::create('rsia_erm_menu_akses', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('menu_id');
                $table->enum('tipe_akses', ['dep', 'dokter', 'all'])->default('dep');
                $table->string('target_id', 50)->nullable(); // kd_dep atau 'dokter'
                $table->timestamps();

                $table->foreign('menu_id')->references('id')->on('rsia_erm_menu')->onDelete('cascade');
                $table->index(['menu_id', 'tipe_akses', 'target_id'], 'idx_menu_akses');
            });
        }

        // 3. Akses Khusus per User / NIK (Override)
        if (!Schema::hasTable('rsia_erm_menu_user')) {
            Schema::create('rsia_erm_menu_user', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('menu_id');
                $table->string('nik', 50);
                $table->boolean('is_allowed')->default(true);
                $table->timestamps();

                $table->foreign('menu_id')->references('id')->on('rsia_erm_menu')->onDelete('cascade');
                $table->index(['menu_id', 'nik'], 'idx_menu_user');
            });
        }

        // AUTO-SEED ATURAN MENU SAAT INI
        $this->seedInitialMenus();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rsia_erm_menu_user');
        Schema::dropIfExists('rsia_erm_menu_akses');
        Schema::dropIfExists('rsia_erm_menu');
    }

    private function seedInitialMenus()
    {
        $now = date('Y-m-d H:i:s');

        // Master menu data
        $menus = [
            1 => [
                'nama_menu' => 'Poliklinik',
                'url' => '/erm/poliklinik',
                'icon' => 'bi-bandaid',
                'icon_bg' => 'icon-poli',
                'kategori' => 'Pelayanan Pasien',
                'urutan' => 1,
                'target' => '_self',
                'title' => 'Pelayanan Pasien Poliklinik (Rawat Jalan)',
                'akses' => [
                    'dokter' => true,
                    'deps' => ['DM6', 'DM7', 'DPM1', 'DPM2', 'CSM', 'SPS', 'IT', 'DIR'],
                ]
            ],
            2 => [
                'nama_menu' => 'Rawat Inap',
                'url' => '/erm/ranap',
                'icon' => 'bi-hospital',
                'icon_bg' => 'icon-ranap',
                'kategori' => 'Pelayanan Pasien',
                'urutan' => 2,
                'target' => '_self',
                'title' => 'Pelayanan Pasien Rawat Inap & E-MAR',
                'akses' => [
                    'dokter' => true,
                    'deps' => ['DM1', 'DM2', 'DM3', 'DM4', 'DM5', 'DM8', 'DNM5', 'DPM1', 'DPM2', 'CSM', 'SPS', 'ICU', 'IT', 'DIR'],
                ]
            ],
            3 => [
                'nama_menu' => 'UGD',
                'url' => '/erm/ugd',
                'icon' => 'bi-clipboard2-pulse',
                'icon_bg' => 'icon-ugd',
                'kategori' => 'Pelayanan Pasien',
                'urutan' => 3,
                'target' => '_self',
                'title' => 'Instalasi Gawat Darurat (UGD)',
                'akses' => [
                    'dokter' => true,
                    'deps' => ['DM1', 'DM7', 'DPM2', 'CSM', 'SPS', 'IT', 'DIR'],
                ]
            ],
            4 => [
                'nama_menu' => 'Kamar Operasi',
                'url' => '/erm/operasi',
                'icon' => 'bi-heart-pulse-fill',
                'icon_bg' => 'icon-ok',
                'kategori' => 'Pelayanan Pasien',
                'urutan' => 4,
                'target' => '_self',
                'title' => 'Kamar Operasi (IBS) & Laporan Operasi',
                'akses' => [
                    'dokter' => true,
                    'deps' => ['OK', 'IBS', 'DM1', 'DM2', 'DM3', 'DM4', 'DM5', 'DM7', 'DPM1', 'DPM2', 'CSM', 'SPS', 'ICU', 'IT', 'DIR'],
                ]
            ],
            5 => [
                'nama_menu' => 'Laborat',
                'url' => '/lab',
                'icon' => 'bi-prescription2',
                'icon_bg' => 'icon-lab',
                'kategori' => 'Penunjang & Resep',
                'urutan' => 5,
                'target' => '_self',
                'title' => 'Pelayanan & Hasil Pemeriksaan Laboratorium',
                'akses' => [
                    'all' => true,
                ]
            ],
            6 => [
                'nama_menu' => 'Radiologi',
                'url' => '/erm/radiologi',
                'icon' => 'bi-radioactive',
                'icon_bg' => 'icon-rad',
                'kategori' => 'Penunjang & Resep',
                'urutan' => 6,
                'target' => '_self',
                'title' => 'Pelayanan & Hasil Radiologi',
                'akses' => [
                    'deps' => ['RAD', 'CSM', 'IT', 'DIR'],
                ]
            ],
            7 => [
                'nama_menu' => 'Resep',
                'url' => '/erm/resep',
                'icon' => 'bi-prescription',
                'icon_bg' => 'icon-resep',
                'kategori' => 'Penunjang & Resep',
                'urutan' => 7,
                'target' => '_self',
                'title' => 'Daftar Resep Obat Dokter',
                'akses' => [
                    'deps' => ['DPM1', 'IT', 'DIR'],
                ]
            ],
            8 => [
                'nama_menu' => 'Obat & BHP',
                'url' => '/erm/obat',
                'icon' => 'bi-capsule-pill',
                'icon_bg' => 'icon-obat',
                'kategori' => 'Penunjang & Resep',
                'urutan' => 8,
                'target' => '_self',
                'title' => 'Master Data Obat & Bahan Medis Habis Pakai',
                'akses' => [
                    'dokter' => true,
                    'deps' => ['DPM1', 'DPM2', 'DM6', 'DM7', 'CSM', 'SPS', 'IT', 'DIR'],
                ]
            ],
            9 => [
                'nama_menu' => 'Template Racik',
                'url' => '/erm/resep/racik',
                'icon' => 'bi-mortarboard',
                'icon_bg' => 'icon-racik',
                'kategori' => 'Penunjang & Resep',
                'urutan' => 9,
                'target' => '_self',
                'title' => 'Template Racikan Obat Dokter',
                'akses' => [
                    'dokter' => true,
                    'deps' => ['DPM1', 'DPM2', 'DM6', 'DM7', 'CSM', 'SPS', 'IT', 'DIR'],
                ]
            ],
            10 => [
                'nama_menu' => 'Data Pasien',
                'url' => '/erm/pasien',
                'icon' => 'bi-people',
                'icon_bg' => 'icon-pasien',
                'kategori' => 'Data Pasien & Reg',
                'urutan' => 10,
                'target' => '_self',
                'title' => 'Master Data Pasien & Riwayat RM',
                'akses' => [
                    'deps' => ['DPM2', 'CSM', 'DNM2', 'IT', 'DIR'],
                    'users' => ['2.326.0418'],
                ]
            ],
            11 => [
                'nama_menu' => 'Pendaftaran',
                'url' => '/erm/registrasi',
                'icon' => 'bi-pen',
                'icon_bg' => 'icon-daftar',
                'kategori' => 'Data Pasien & Reg',
                'urutan' => 11,
                'target' => '_self',
                'title' => 'Pendaftaran Pasien Baru / Lama',
                'akses' => [
                    'deps' => ['DNM6', 'IT', 'DIR'],
                ]
            ],
            12 => [
                'nama_menu' => 'SEP Terbit',
                'url' => '/erm/sep',
                'icon' => 'bi-link-45deg',
                'icon_bg' => 'icon-sep',
                'kategori' => 'Data Pasien & Reg',
                'urutan' => 12,
                'target' => '_self',
                'title' => 'Monitoring Surat Eligibilitas Peserta (SEP BPJS)',
                'akses' => [
                    'deps' => ['DNM6', 'DM6', 'IT', 'DIR'],
                ]
            ],
            13 => [
                'nama_menu' => 'KYC SatuSehat',
                'url' => 'KYC_DYNAMIC',
                'icon' => 'bi-key',
                'icon_bg' => 'icon-kyc',
                'kategori' => 'Sistem',
                'urutan' => 13,
                'target' => '_blank',
                'title' => 'Verifikasi SatuSehat KYC Kemenkes',
                'akses' => [
                    'all' => true,
                ]
            ],
            14 => [
                'nama_menu' => 'App Logs',
                'url' => '/erm/logs',
                'icon' => 'bi-journal-code',
                'icon_bg' => 'icon-log',
                'kategori' => 'Sistem',
                'urutan' => 14,
                'target' => '_blank',
                'title' => 'System Application Logs',
                'akses' => [
                    'deps' => ['IT'],
                    'users' => ['direksi'],
                ]
            ],
            15 => [
                'nama_menu' => 'Manajemen Menu',
                'url' => '/erm/pengaturan/menu',
                'icon' => 'bi-sliders',
                'icon_bg' => 'icon-menu-manage',
                'kategori' => 'Sistem',
                'urutan' => 15,
                'target' => '_self',
                'title' => 'Pengaturan Menu & Hak Akses Pengguna',
                'akses' => [
                    'deps' => ['IT', 'DIR'],
                    'users' => ['direksi'],
                ]
            ]
        ];

        foreach ($menus as $mId => $item) {
            DB::table('rsia_erm_menu')->insert([
                'id' => $mId,
                'nama_menu' => $item['nama_menu'],
                'url' => $item['url'],
                'icon' => $item['icon'],
                'icon_bg' => $item['icon_bg'],
                'kategori' => $item['kategori'],
                'urutan' => $item['urutan'],
                'target' => $item['target'],
                'title' => $item['title'],
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $akses = $item['akses'];

            // All users
            if (!empty($akses['all'])) {
                DB::table('rsia_erm_menu_akses')->insert([
                    'menu_id' => $mId,
                    'tipe_akses' => 'all',
                    'target_id' => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            // Dokter
            if (!empty($akses['dokter'])) {
                DB::table('rsia_erm_menu_akses')->insert([
                    'menu_id' => $mId,
                    'tipe_akses' => 'dokter',
                    'target_id' => 'dokter',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            // Departemen
            if (!empty($akses['deps'])) {
                foreach ($akses['deps'] as $dep) {
                    DB::table('rsia_erm_menu_akses')->insert([
                        'menu_id' => $mId,
                        'tipe_akses' => 'dep',
                        'target_id' => $dep,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }

            // Users khusus
            if (!empty($akses['users'])) {
                foreach ($akses['users'] as $nik) {
                    DB::table('rsia_erm_menu_user')->insert([
                        'menu_id' => $mId,
                        'nik' => $nik,
                        'is_allowed' => true,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }
        }
    }
}
