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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->char('nama_kelas', 20);
            $table->integer('tingkat');
            $table->unsignedBigInteger('guru_id')->comment('Wali Kelas');
            $table->unsignedBigInteger('jurusan_id');
            $table->unsignedBigInteger('tahun_ajaran_id');
            $table->timestamps();

            $table->foreign('guru_id', 'fk-kelas-guru_id')
                ->references('id')
                ->on('guru')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('jurusan_id', 'fk-kelas-jurusan_id')
                ->references('id')
                ->on('jurusan')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('tahun_ajaran_id', 'fk-kelas-tahun_ajaran_id')
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
        Schema::table('kelas', function (Blueprint $table) {
            $table->dropForeign('fk-kelas-guru_id');
            $table->dropForeign('fk-kelas-jurusan_id');
            $table->dropForeign('fk-kelas-tahun_ajaran_id');
        });

        Schema::dropIfExists('kelas');
    }
};
