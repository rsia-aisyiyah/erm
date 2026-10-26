<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRsiaReturStokUddTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rsia_retur_stok_udd', function (Blueprint $table) {
            $table->string('no_retur_udd', 25)->primary();
            $table->string('no_rawat', 17)->index();
            $table->string('kd_bangsal', 5)->default('RM');
            $table->date('tgl_retur');
            $table->time('jam_retur');
            $table->string('petugas_ruangan', 20);
            $table->string('alasan', 100)->default('Pasien Boleh Pulang (KRS)');
            $table->enum('status', ['Menunggu Diterima', 'Diterima', 'Ditolak', 'Batal'])->default('Menunggu Diterima');
            $table->string('petugas_farmasi', 20)->nullable();
            $table->date('tgl_diterima')->nullable();
            $table->time('jam_diterima')->nullable();
            $table->text('catatan')->nullable();
            $table->text('catatan_farmasi')->nullable();
            $table->timestamps();
        });

        Schema::create('rsia_detail_retur_stok_udd', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_retur_udd', 25)->index();
            $table->string('kode_brng', 15)->index();
            $table->double('jml_retur')->default(0);
            $table->double('jml_diterima')->default(0);
            $table->string('no_batch', 20)->default('');
            $table->string('no_faktur', 20)->default('');
            $table->string('keterangan', 100)->nullable();
            $table->timestamps();

            $table->foreign('no_retur_udd')
                ->references('no_retur_udd')
                ->on('rsia_retur_stok_udd')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rsia_detail_retur_stok_udd');
        Schema::dropIfExists('rsia_retur_stok_udd');
    }
}
