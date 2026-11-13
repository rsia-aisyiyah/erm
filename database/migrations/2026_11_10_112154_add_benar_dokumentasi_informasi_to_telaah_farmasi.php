<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBenarDokumentasiInformasiToTelaahFarmasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('telaah_farmasi', function (Blueprint $table) {
            $table->enum('obat_benar_dokumentasi', ['Ya', 'Tidak'])->default('Ya')->nullable()->after('obat_tepat_waktu_pemberian');
            $table->enum('obat_benar_informasi', ['Ya', 'Tidak'])->default('Ya')->nullable()->after('obat_benar_dokumentasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('telaah_farmasi', function (Blueprint $table) {
            $table->dropColumn(['obat_benar_dokumentasi', 'obat_benar_informasi']);
        });
    }
}
