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
        Schema::table('adopsi', function (Blueprint $table) {
            $table->text('alasan')->nullable()->after('hewan_id');
            $table->string('path_surat_pernyataan')->nullable()->after('alasan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('adopsi', function (Blueprint $table) {
            $table->dropColumn(['alasan', 'path_surat_pernyataan']);
        });
    }
};
