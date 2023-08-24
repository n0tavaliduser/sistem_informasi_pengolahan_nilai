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
        Schema::create('nilai_mata_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mata_pelajaran_id');
            $table->unsignedBigInteger('siswa_id');
            $table->integer('pertemuan');
            $table->integer('nilai');
            $table->timestamps();

            $table->foreign('mata_pelajaran_id', 'fk-nilai_mata_pelajaran-mata_pelajaran_id')
                ->references('id')
                ->on('mata_pelajaran')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('siswa_id', 'fk-nilai_mata_pelajaran-siswa_id')
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
        Schema::table('nilai_mata_pelajaran', function (Blueprint $table) {
            $table->dropForeign('fk-nilai_mata_pelajaran-mata_pelajaran_id');
            $table->dropForeign('fk-nilai_mata_pelajaran-siswa_id');
        });

        Schema::dropIfExists('nilai_mata_pelajaran');
    }
};
