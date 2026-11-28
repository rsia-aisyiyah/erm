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
        if (Schema::hasTable('rsia_order_surat_kontrol_ranap')) {
            Schema::table('rsia_order_surat_kontrol_ranap', function (Blueprint $table) {
                if (!Schema::hasColumn('rsia_order_surat_kontrol_ranap', 'wa_event')) {
                    $table->string('wa_event', 30)->default('NEW_ORDER')->after('executed_by');
                }
                if (!Schema::hasColumn('rsia_order_surat_kontrol_ranap', 'wa_notified_at')) {
                    $table->dateTime('wa_notified_at')->nullable()->after('wa_event');
                    $table->index('wa_notified_at');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('rsia_order_surat_kontrol_ranap')) {
            Schema::table('rsia_order_surat_kontrol_ranap', function (Blueprint $table) {
                if (Schema::hasColumn('rsia_order_surat_kontrol_ranap', 'wa_notified_at')) {
                    $table->dropIndex(['wa_notified_at']);
                    $table->dropColumn('wa_notified_at');
                }
                if (Schema::hasColumn('rsia_order_surat_kontrol_ranap', 'wa_event')) {
                    $table->dropColumn('wa_event');
                }
            });
        }
    }
};
