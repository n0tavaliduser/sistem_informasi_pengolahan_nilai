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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor_induk')->unique('idx-siswa-nomor_induk');
            $table->char('nama_lengkap', 200);
            $table->char('agamar', 25);
            $table->char('status', 25);
            $table->text('foto')->nullable();
            $table->text('catatan')->nullable();
            $table->char('jenis_kelamin', 30);
            $table->char('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->char('telepon');
            $table->string('email')->unique('idx-siswa-email');
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('tahun_ajaran_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('kelas_id', 'fk-siswa-kelas_id')
                ->references('id')
                ->on('kelas')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('tahun_ajaran_id', 'fk-siswa-tahun_ajaran_id')
                ->references('id')
                ->on('tahun_ajaran')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('user_id', 'fk-siswa-user_id')
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
        Schema::table('siswa', function (Blueprint $table) {
            $table->dropForeign('fk-siswa-kelas_id');
            $table->dropForeign('fk-siswa-tahun_ajaran_id');
        });

        Schema::dropIfExists('siswa');
    }
};
