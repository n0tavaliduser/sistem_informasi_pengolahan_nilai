<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TahunAjaran
 * 
 * @property int $id
 * @property Carbon $tahun_mulai
 * @property Carbon $tahun_berakhir
 * @property int $jumlah_semester
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Absensi[] $absensis
 * @property Collection|JadwalPelajaran[] $jadwal_pelajarans
 * @property Collection|Kela[] $kelas
 * @property Collection|Semester[] $semesters
 * @property Collection|Siswa[] $siswas
 *
 * @package App\Models
 */
class TahunAjaran extends Model
{
	protected $table = 'tahun_ajaran';

	protected $casts = [
		'tahun_mulai' => 'datetime',
		'tahun_berakhir' => 'datetime',
		'jumlah_semester' => 'int'
	];

	protected $fillable = [
		'tahun_mulai',
		'tahun_berakhir',
		'jumlah_semester',
		'status'
	];

	public function absensis()
	{
		return $this->hasMany(Absensi::class, 'siswa_id');
	}

	public function jadwal_pelajarans()
	{
		return $this->hasMany(JadwalPelajaran::class);
	}

	public function kelas()
	{
		return $this->hasMany(Kela::class);
	}

	public function semesters()
	{
		return $this->hasMany(Semester::class);
	}

	public function siswas()
	{
		return $this->hasMany(Siswa::class);
	}
}
