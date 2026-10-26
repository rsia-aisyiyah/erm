<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        // Drop FK telaah_farmasi_ibfk_1 if exists to allow no_permintaan (UDD / SP...)
        try {
            DB::statement('ALTER TABLE telaah_farmasi DROP FOREIGN KEY telaah_farmasi_ibfk_1');
        } catch (\Exception $e) {
            // Already dropped or doesn't exist
        }

        // Expand no_resep column to 20 chars
        try {
            DB::statement('ALTER TABLE telaah_farmasi MODIFY COLUMN no_resep VARCHAR(20) NOT NULL');
        } catch (\Exception $e) {
            // Ignore if already modified
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        try {
            DB::statement('ALTER TABLE telaah_farmasi MODIFY COLUMN no_resep VARCHAR(14) NOT NULL');
        } catch (\Exception $e) {
            //
        }
    }
};
