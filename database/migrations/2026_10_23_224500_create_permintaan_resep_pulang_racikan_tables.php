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
        if (!Schema::hasTable('permintaan_resep_pulang_racikan')) {
            Schema::create('permintaan_resep_pulang_racikan', function (Blueprint $table) {
                $table->string('no_permintaan', 14);
                $table->integer('no_racik');
                $table->string('nama_racik', 100);
                $table->string('kd_racik', 10)->default('Puyer');
                $table->integer('jml_dr')->default(1);
                $table->string('aturan_pakai', 150);
                $table->string('keterangan', 100)->nullable()->default('');
                
                $table->primary(['no_permintaan', 'no_racik']);
                $table->index('no_permintaan');
            });
        }

        if (!Schema::hasTable('permintaan_resep_pulang_racikan_detail')) {
            Schema::create('permintaan_resep_pulang_racikan_detail', function (Blueprint $table) {
                $table->string('no_permintaan', 14);
                $table->integer('no_racik');
                $table->string('kode_brng', 15);
                $table->double('p1')->nullable()->default(1);
                $table->double('p2')->nullable()->default(1);
                $table->double('kandungan')->nullable()->default(0);
                $table->double('jml')->default(1);

                $table->primary(['no_permintaan', 'no_racik', 'kode_brng'], 'pk_resep_pulang_racik_det');
                $table->index(['no_permintaan', 'no_racik'], 'idx_resep_pulang_racik');
                $table->index('kode_brng');
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
        Schema::dropIfExists('permintaan_resep_pulang_racikan_detail');
        Schema::dropIfExists('permintaan_resep_pulang_racikan');
    }
};
