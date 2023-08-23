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
        Schema::create('pengumpulan_tugas', function (Blueprint $table) {
            $table->id();
            $table->text('file')->nullable();
            $table->char('title')->nullable();
            $table->text('deskripsi')->nullable();
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('mata_pelajaran_id');
            $table->unsignedBigInteger('tugas_id');
            $table->integer('nilai')->nullable();
            $table->timestamps();

            $table->foreign('kelas_id', 'fk-pengumpulan_tugas-kelas_id')
                ->references('id')
                ->on('kelas')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('siswa_id', 'fk-pengumpulan_tugas-siswa_id')
                ->references('id')
                ->on('siswa')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('mata_pelajaran_id', 'fk-pengumpulan_tugas-mata_pelajaran_id')
                ->references('id')
                ->on('mata_pelajaran')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('tugas_id', 'fk-pengumpulan_tugas-tugas_id')
                ->references('id')
                ->on('tugas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengumpulan_tugas', function (Blueprint $table) {
            $table->dropForeign('fk-pengumpulan_tugas-kelas_id');
            $table->dropForeign('fk-pengumpulan_tugas-siswa_id');
            $table->dropForeign('fk-pengumpulan_tugas-mata_pelajaran_id');
            $table->dropForeign('fk-pengumpulan_tugas-tugas_id');
        });

        Schema::dropIfExists('pengumpulan_tugas');
    }
};
