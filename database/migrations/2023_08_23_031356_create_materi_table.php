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
        Schema::create('materi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jadwal_pelajaran_id');
            $table->char('judul', 100);
            $table->date('tanggal');
            $table->text('file');
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->foreign('jadwal_pelajaran_id', 'fk-materi-jadwal_pelajaran_id')
                ->references('id')
                ->on('jadwal_pelajaran')
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
            $table->dropForeign('fk-materi-jadwal_pelajaran_id');
        });

        Schema::dropIfExists('materi');
    }
};
