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
        Schema::create('mata_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->char('nama', 75);
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('jurusan_id');
            $table->unsignedBigInteger('guru_id')->nullable();
            $table->timestamps();

            $table->foreign('jurusan_id', 'fk-mata_pelajaran-jurusan_id')
                ->references('id')
                ->on('jurusan')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('guru_id', 'fk-mata_pelajaran-guru_id')
                ->references('id')
                ->on('guru')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mata_pelajaran', function (Blueprint $table) {
            $table->dropForeign('fk-mata_pelajaran-jurusan_id');
        });

        Schema::dropIfExists('mata_pelajaran');
    }
};
