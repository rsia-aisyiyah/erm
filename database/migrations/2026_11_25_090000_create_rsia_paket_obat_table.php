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
        if (!Schema::hasTable('rsia_paket_obat')) {
            Schema::create('rsia_paket_obat', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('nama_paket', 150);
                $table->string('unit', 50)->default('Kamar Operasi')->comment('Kamar Operasi, UGD, VK, Ranap, Semua');
                $table->text('keterangan')->nullable();
                $table->enum('status', ['1', '0'])->default('1')->comment('1: Aktif, 0: Nonaktif');
                $table->string('kd_dokter', 20)->nullable()->comment('Opsional untuk preferensi dokter');
                $table->string('created_by', 50)->nullable();
                $table->timestamps();

                $table->index('unit');
                $table->index('status');
                $table->index('kd_dokter');
            });
        }

        if (!Schema::hasTable('rsia_paket_obat_detail')) {
            Schema::create('rsia_paket_obat_detail', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('paket_id');
                $table->string('kode_brng', 15);
                $table->double('jumlah')->default(1);
                $table->string('aturan_pakai', 150)->default('-');
                $table->string('keterangan', 100)->nullable();
                $table->integer('urutan')->default(0);

                $table->index('paket_id');
                $table->index('kode_brng');

                $table->foreign('paket_id')
                    ->references('id')
                    ->on('rsia_paket_obat')
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rsia_paket_obat_detail');
        Schema::dropIfExists('rsia_paket_obat');
    }
};
