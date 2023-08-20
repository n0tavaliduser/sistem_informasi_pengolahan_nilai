<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Absensi
 * 
 * @property int $id
 * @property Carbon $tanggal
 * @property string $keterangan
 * @property int $siswa_id
 * @property int $kelas_id
 * @property int $tahun_ajaran_id
 * @property string $semester
 * @property int $mata_pelajaran_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Kela $kela
 * @property MataPelajaran $mata_pelajaran
 * @property TahunAjaran $tahun_ajaran
 *
 * @package App\Models
 */
class Absensi extends Model
{
	protected $table = 'absensi';

	protected $casts = [
		'tanggal' => 'datetime',
		'siswa_id' => 'int',
		'kelas_id' => 'int',
		'tahun_ajaran_id' => 'int',
		'mata_pelajaran_id' => 'int'
	];

	protected $fillable = [
		'tanggal',
		'keterangan',
		'siswa_id',
		'kelas_id',
		'tahun_ajaran_id',
		'semester',
		'mata_pelajaran_id'
	];

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
		return $this->belongsTo(TahunAjaran::class, 'siswa_id');
	}
}
