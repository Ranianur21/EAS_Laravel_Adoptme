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
            // Hapus kolom yang tidak relevan jika 'adopsi' ini hanya untuk pengajuan
            // Pastikan untuk memeriksa apakah kolom ini ada sebelum menghapus
            if (Schema::hasColumn('adopsi', 'nama')) {
                $table->dropColumn('nama');
            }
            if (Schema::hasColumn('adopsi', 'nama_lengkap')) {
                $table->dropColumn('nama_lengkap');
            }
            if (Schema::hasColumn('adopsi', 'email')) {
                $table->dropColumn('email');
            }
            if (Schema::hasColumn('adopsi', 'alamat')) {
                $table->dropColumn('alamat');
            }

            // Tambahkan foreign key ke tabel 'pengguna'
            $table->foreignId('user_id')
                  ->after('id') // Posisikan setelah 'id'
                  ->constrained('pengguna') // Merujuk ke tabel 'pengguna'
                  ->onDelete('cascade'); // Jika user dihapus, pengajuannya juga dihapus

            // Tambahkan kolom untuk menyimpan path file bukti surat adopsi
            $table->string('bukti_surat_adopsi_path')->nullable()->after('hewan_id'); // Atau setelah 'status'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('adopsi', function (Blueprint $table) {
            // Balikkan perubahan saat rollback
            $table->dropConstrainedForeignId('user_id'); // Hapus foreign key constraint dan kolom
            $table->dropColumn('bukti_surat_adopsi_path');

            // Opsional: Jika Anda menghapus kolom di up(), Anda bisa menambahkannya kembali di down()
            // Tetapi seringkali lebih aman untuk tidak mengembalikan kolom yang dihapus di down()
            // $table->string('nama', 255)->nullable();
            // $table->string('nama_lengkap', 255)->nullable();
            // $table->string('email', 255)->nullable();
            // $table->text('alamat')->nullable();
        });
    }
};