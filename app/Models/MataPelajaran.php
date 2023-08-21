<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MataPelajaran
 * 
 * @property int $id
 * @property string $nama
 * @property string $kode
 * @property string|null $keterangan
 * @property int $jurusan_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Jurusan $jurusan
 * @property Collection|Absensi[] $absensis
 * @property Collection|JadwalPelajaran[] $jadwal_pelajarans
 * @property Collection|PengumpulanTuga[] $pengumpulan_tugas
 * @property Collection|Tuga[] $tugas
 *
 * @package App\Models
 */
class MataPelajaran extends Model
{
	protected $table = 'mata_pelajaran';

	protected $casts = [
		'jurusan_id' => 'int'
	];

	protected $fillable = [
		'nama',
		'kode',
		'keterangan',
		'jurusan_id'
	];

	public function jurusan()
	{
		return $this->belongsTo(Jurusan::class);
	}

	public function absensis()
	{
		return $this->hasMany(Absensi::class);
	}

	public function jadwal_pelajarans()
	{
		return $this->hasMany(JadwalPelajaran::class);
	}

	public function pengumpulan_tugas()
	{
		return $this->hasMany(PengumpulanTuga::class);
	}

	public function tugas()
	{
		return $this->hasMany(Tugas::class);
	}
}
