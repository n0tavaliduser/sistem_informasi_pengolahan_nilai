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
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guru_id');
            $table->unsignedBigInteger('mata_pelajaran_id');
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->date('tanggal_deadline');
            $table->text('file')->nullable();
            $table->enum('status', ['open', 'closed']);
            $table->string('tipe')->comment('Tugas Harian / UTS / UAS');
            $table->timestamps();

            $table->foreign('guru_id', 'fk-tugas-guru_id')
                ->references('id')
                ->on('guru')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->foreign('mata_pelajaran_id', 'fk-tugas-mata_pelajaran_id')
                ->references('id')
                ->on('mata_pelajaran')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tugas', function (Blueprint $table) {
            $table->dropForeign('fk-tugas-guru_id');
            $table->dropForeign('fk-tugas-mata_pelajaran_id');
        });

        Schema::dropIfExists('tugas');
    }
};

