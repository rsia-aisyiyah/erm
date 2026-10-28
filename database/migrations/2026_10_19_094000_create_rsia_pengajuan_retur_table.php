<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rsia_pengajuan_retur', function (Blueprint $table) {
            $table->string('no_pengajuan', 25)->primary();
            $table->string('no_rawat', 17)->index();
            $table->char('kd_bangsal', 5)->default('RM');
            $table->date('tgl_pengajuan');
            $table->time('jam_pengajuan');
            $table->string('petugas_pengaju', 20)->index();
            $table->enum('status', ['Menunggu Validasi', 'Disetujui', 'Ditolak', 'Batal'])->default('Menunggu Validasi');
            $table->string('petugas_validasi', 20)->nullable()->index();
            $table->date('tgl_validasi')->nullable();
            $table->time('jam_validasi')->nullable();
            $table->string('no_retur_jual', 20)->nullable()->index();
            $table->text('catatan')->nullable();
            $table->text('catatan_farmasi')->nullable();
            $table->timestamps();
        });

        Schema::create('rsia_detail_pengajuan_retur', function (Blueprint $table) {
            $table->id();
            $table->string('no_pengajuan', 25)->index();
            $table->string('kode_brng', 15)->index();
            $table->char('kode_sat', 4)->nullable();
            $table->double('jml_diajukan')->default(0);
            $table->double('jml_disetujui')->default(0);
            $table->double('h_retur')->default(0);
            $table->double('subtotal')->default(0);
            $table->string('no_batch', 20)->default('');
            $table->string('no_faktur', 20)->default('');
            $table->string('keterangan', 100)->nullable();
            $table->timestamps();

            $table->foreign('no_pengajuan')
                ->references('no_pengajuan')
                ->on('rsia_pengajuan_retur')
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
        Schema::dropIfExists('rsia_detail_pengajuan_retur');
        Schema::dropIfExists('rsia_pengajuan_retur');
    }
};
