<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Nilai
 * 
 * @property int $id
 * @property int $siswa_id
 * @property int $mata_pelajaran_id
 * @property int $nilai
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property MataPelajaran $mata_pelajaran
 * @property Siswa $siswa
 *
 * @package App\Models
 */
class Nilai extends Model
{
	protected $table = 'nilai';

	protected $casts = [
		'siswa_id' => 'int',
		'mata_pelajaran_id' => 'int',
		'nilai' => 'int'
	];

	protected $fillable = [
		'siswa_id',
		'mata_pelajaran_id',
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
