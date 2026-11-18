<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRsiaSubstitusiObatPasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('rsia_substitusi_obat_pasien')) {
            Schema::create('rsia_substitusi_obat_pasien', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('no_permintaan', 20)->index();
                $table->string('no_rawat', 17)->index();
                $table->string('kode_brng_asal', 15)->index();
                $table->string('nama_brng_asal', 100);
                $table->string('kode_brng_pengganti', 15)->index();
                $table->string('nama_brng_pengganti', 100);
                $table->string('kd_dokter', 20)->nullable();
                $table->string('nama_dokter', 100)->nullable();
                $table->boolean('konfirmasi_dokter')->default(true);
                $table->string('catatan', 255)->nullable();
                $table->string('nip_farmasi', 20)->nullable();
                $table->timestamps();

                $table->index(['no_rawat', 'kode_brng_pengganti'], 'idx_rawat_brng_pengganti');
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
        Schema::dropIfExists('rsia_substitusi_obat_pasien');
    }
}
