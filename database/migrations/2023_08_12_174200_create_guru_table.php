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
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->char('nama_lengkap', 150);
            $table->char('jenis_kelamin');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->unsignedBigInteger('jurusan_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('jurusan_id', 'fk-guru-jurusan_id')
                ->references('id')
                ->on('jurusan')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('user_id', 'fk-guru-user_id')   
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guru', function (Blueprint $table) {
            $table->dropForeign('fk-guru-jurusan_id');
            $table->dropForeign('fk-guru-user_id');
        });

        Schema::dropIfExists('guru');
    }
};
