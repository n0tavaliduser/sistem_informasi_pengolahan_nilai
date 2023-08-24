<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class NilaiMataPelajaran
 * 
 * @property int $id
 * @property int $mata_pelajaran_id
 * @property int $siswa_id
 * @property int $pertemuan
 * @property int $nilai
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property MataPelajaran $mata_pelajaran
 * @property Siswa $siswa
 *
 * @package App\Models
 */
class NilaiMataPelajaran extends Model
{
	protected $table = 'nilai_mata_pelajaran';

	protected $casts = [
		'mata_pelajaran_id' => 'int',
		'siswa_id' => 'int',
		'pertemuan' => 'int',
		'nilai' => 'int'
	];

	protected $fillable = [
		'mata_pelajaran_id',
		'siswa_id',
		'pertemuan',
		'nilai'
	];

	public function mata_pelajaran()
	{
		return $this->belongsTo(MataPelajaran::class);
	}

	public function siswa()
	{
		return $this->belongsTo(Siswa::class);
	}
}
