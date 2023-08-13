<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Kelas
 * 
 * @property int $id
 * @property string $nama_kelas
 * @property int $tingkat
 * @property int $guru_id
 * @property int $jurusan_id
 * @property int $tahun_ajaran_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Guru $guru
 * @property Jurusan $jurusan
 * @property TahunAjaran $tahun_ajaran
 * @property Collection|Absensi[] $absensis
 * @property Collection|JadwalPelajaran[] $jadwal_pelajarans
 * @property Collection|Siswa[] $siswas
 *
 * @package App\Models
 */
class Kelas extends Model
{
	protected $table = 'kelas';

	protected $casts = [
		'tingkat' => 'int',
		'guru_id' => 'int',
		'jurusan_id' => 'int',
		'tahun_ajaran_id' => 'int'
	];

	protected $fillable = [
		'nama_kelas',
		'tingkat',
		'guru_id',
		'jurusan_id',
		'tahun_ajaran_id'
	];

	public function guru()
	{
		return $this->belongsTo(Guru::class);
	}

	public function jurusan()
	{
		return $this->belongsTo(Jurusan::class);
	}

	public function tahun_ajaran()
	{
		return $this->belongsTo(TahunAjaran::class);
	}

	public function absensis()
	{
		return $this->hasMany(Absensi::class, 'kelas_id');
	}

	public function jadwal_pelajarans()
	{
		return $this->hasMany(JadwalPelajaran::class, 'kelas_id');
	}

	public function siswas()
	{
		return $this->hasMany(Siswa::class, 'kelas_id');
	}
}
