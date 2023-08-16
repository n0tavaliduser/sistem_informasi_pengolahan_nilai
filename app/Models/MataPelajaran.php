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
 * @property string|null $keterangan
 * @property int $jurusan_id
 * @property int|null $guru_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Guru|null $guru
 * @property Jurusan $jurusan
 * @property Collection|Absensi[] $absensis
 * @property Collection|Tuga[] $tugas
 *
 * @package App\Models
 */
class MataPelajaran extends Model
{
	protected $table = 'mata_pelajaran';

	protected $casts = [
		'jurusan_id' => 'int',
		'guru_id' => 'int'
	];

	protected $fillable = [
		'nama',
		'keterangan',
		'jurusan_id',
		'guru_id'
	];

	public function guru()
	{
		return $this->belongsTo(Guru::class);
	}

	public function jurusan()
	{
		return $this->belongsTo(Jurusan::class);
	}

	public function absensis()
	{
		return $this->hasMany(Absensi::class);
	}

	public function tugas()
	{
		return $this->hasMany(Tuga::class);
	}
}
