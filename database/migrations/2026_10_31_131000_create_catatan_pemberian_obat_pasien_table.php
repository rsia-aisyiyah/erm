<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatatanPemberianObatPasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('catatan_pemberian_obat_pasien')) {
            Schema::create('catatan_pemberian_obat_pasien', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('no_rawat', 17)->index();
                $table->string('kode_brng', 15)->index();
                $table->date('tgl_perawatan')->index();
                $table->time('jam');
                $table->double('dosis_klinis')->default(1);
                $table->string('satuan', 30)->default('');
                $table->string('aturan_pakai', 100)->default('-');
                $table->string('kd_bangsal', 5)->default('RM');
                $table->string('no_batch', 25)->default('');
                $table->string('no_faktur', 25)->default('');
                $table->string('nip_perawat', 20)->default('-');
                $table->enum('sumber', ['resep_dokter', 'permintaan_harian'])->default('permintaan_harian');
                $table->string('no_resep', 20)->nullable()->index();
                $table->enum('status_pemberian', ['Sudah Diberikan', 'Ditunda', 'Ditolak Pasien'])->default('Sudah Diberikan');
                $table->string('keterangan', 255)->nullable();
                $table->enum('status_billing', ['Sudah Dibilkan', 'Menunggu Verifikasi', 'Tidak Dibilkan'])->default('Menunggu Verifikasi');
                $table->double('jml_billing')->default(0);
                $table->dateTime('tgl_verifikasi_billing')->nullable();
                $table->string('nip_farmasi', 20)->nullable();
                $table->timestamps();

                $table->index(['no_rawat', 'tgl_perawatan', 'kode_brng'], 'idx_rawat_tgl_brng');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catatan_pemberian_obat_pasien');
    }
}
