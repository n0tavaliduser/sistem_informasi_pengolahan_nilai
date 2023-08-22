<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class JadwalPelajaran
 * 
 * @property int $id
 * @property string $hari
 * @property Carbon $jam_mulai
 * @property Carbon $jam_berakhir
 * @property int $kelas_id
 * @property int $tahun_ajaran_id
 * @property int|null $guru_id
 * @property int|null $mata_pelajaran_id
 * @property string $semester
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Guru|null $guru
 * @property Kela $kela
 * @property MataPelajaran|null $mata_pelajaran
 * @property TahunAjaran $tahun_ajaran
 * @property Collection|Materi[] $materis
 *
 * @package App\Models
 */
class JadwalPelajaran extends Model
{
	protected $table = 'jadwal_pelajaran';

	protected $casts = [
		'jam_mulai' => 'datetime',
		'jam_berakhir' => 'datetime',
		'kelas_id' => 'int',
		'tahun_ajaran_id' => 'int',
		'guru_id' => 'int',
		'mata_pelajaran_id' => 'int'
	];

	protected $fillable = [
		'hari',
		'jam_mulai',
		'jam_berakhir',
		'kelas_id',
		'tahun_ajaran_id',
		'guru_id',
		'mata_pelajaran_id',
		'semester'
	];

	public function guru()
	{
		return $this->belongsTo(Guru::class);
	}

	public function kelas()
	{
		return $this->belongsTo(Kelas::class, 'kelas_id');
	}

	public function mata_pelajaran()
	{
		return $this->belongsTo(MataPelajaran::class);
	}

	public function tahun_ajaran()
	{
		return $this->belongsTo(TahunAjaran::class);
	}

	public function materis()
	{
		return $this->hasMany(Materi::class);
	}
}
