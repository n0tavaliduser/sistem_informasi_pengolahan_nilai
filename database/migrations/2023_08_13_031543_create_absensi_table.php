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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->char('keterangan', 50)->comment('Hadir / Izin / Sakit / Alpa');
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('tahun_ajaran_id');
            $table->char('semester', 8);
            $table->unsignedBigInteger('mata_pelajaran_id');
            $table->timestamps();

            $table->foreign('siswa_id', 'fk-absensi-tahun_ajaran_id')
                ->references('id')
                ->on('tahun_ajaran')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('kelas_id', 'fk-absensi-kelas_id')
                ->references('id')
                ->on('kelas')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('mata_pelajaran_id', 'fk-absensi-mata_pelajaran_id')
                ->references('id')
                ->on('mata_pelajaran')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('siswa_id', 'fk-absensi-siswa_id')
                ->references('id')
                ->on('siswa')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absensi', function (Blueprint $table) {
            $table->dropForeign('fk-absensi-tahun_ajaran_id');
            $table->dropForeign('fk-absensi-kelas_id');
            $table->dropForeign('fk-absensi-mata_pelajaran_id');
            $table->dropForeign('fk-absensi-siswa_id');
        });

        Schema::dropIfExists('absensi');
    }
};
