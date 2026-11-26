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
        if (!Schema::hasTable('rsia_order_surat_kontrol_ranap')) {
            Schema::create('rsia_order_surat_kontrol_ranap', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('no_rawat', 17)->unique();
                $table->string('no_rkm_medis', 15)->nullable();
                $table->string('no_sep', 40)->nullable();
                $table->date('tgl_kontrol_resume');
                $table->string('kd_dokter_dpjp', 20)->nullable();
                $table->string('kd_dokter_bpjs', 20)->nullable();
                $table->string('nm_dokter_bpjs', 100)->nullable();
                $table->string('kd_poli_rs', 10)->nullable();
                $table->string('kd_poli_bpjs', 15)->nullable();
                $table->string('nm_poli_bpjs', 100)->nullable();
                $table->date('tgl_pulang_sep')->nullable();
                $table->date('batas_maksimal_h1')->nullable();
                $table->enum('status_order', [
                    'BELUM_PULANG_SEP',
                    'SIAP_TERBIT',
                    'TERBIT',
                    'GAGAL_TERBIT',
                    'PERLU_UPDATE_SKRJ',
                    'BATAL',
                ])->default('BELUM_PULANG_SEP');
                $table->string('no_surat_kontrol', 40)->nullable();
                $table->text('response_bpjs')->nullable();
                $table->dateTime('terbit_at')->nullable();
                $table->string('created_by', 50)->nullable();
                $table->string('executed_by', 50)->nullable();
                $table->timestamps();

                $table->index('no_sep');
                $table->index('no_rkm_medis');
                $table->index('status_order');
                $table->index('tgl_kontrol_resume');
                $table->index('batas_maksimal_h1');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rsia_order_surat_kontrol_ranap');
    }
};
