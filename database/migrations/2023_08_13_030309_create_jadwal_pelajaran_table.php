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
        Schema::create('jadwal_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->char('hari', 10);
            $table->time('jam_mulai');
            $table->time('jam_berakhir');
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('tahun_ajaran_id');
            $table->char('semester', 8);
            $table->timestamps();

            $table->foreign('kelas_id', 'fk-jadwal_pelajaran-kelas_id')
                ->references('id')
                ->on('kelas')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('tahun_ajaran_id', 'fk-jadwal_pelajaran-tahun_ajaran_id')
                ->references('id')
                ->on('tahun_ajaran')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_pelajaran', function (Blueprint $table) {
            $table->dropForeign('fk-jadwal_pelajaran-kelas_id');
            $table->dropForeign('fk-jadwal_pelajaran-tahun_ajaran_id');
        });

        Schema::dropIfExists('jadwal_pelajaran');
    }
};
