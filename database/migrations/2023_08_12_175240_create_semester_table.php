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
        Schema::create('semester', function (Blueprint $table) {
            $table->id();
            $table->char('nama_semester');
            $table->unsignedBigInteger('tahun_ajaran_id');
            $table->timestamps();

            $table->foreign('tahun_ajaran_id', 'fk-semester-tahun_ajaran_id')
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
        Schema::table('semester', function (Blueprint $table) {
            $table->dropForeign('fk-semester-tahun_ajaran_id');
        });

        Schema::dropIfExists('semester');
    }
};
