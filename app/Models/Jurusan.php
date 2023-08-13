<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Jurusan
 * 
 * @property int $id
 * @property string $nama_jurusan
 * @property string|null $keterangan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Guru[] $gurus
 * @property Collection|Kela[] $kelas
 * @property Collection|MataPelajaran[] $mata_pelajarans
 *
 * @package App\Models
 */
class Jurusan extends Model
{
	protected $table = 'jurusan';

	protected $fillable = [
		'nama_jurusan',
		'keterangan'
	];

	public function gurus()
	{
		return $this->hasMany(Guru::class);
	}

	public function kelas()
	{
		return $this->hasMany(Kela::class);
	}

	public function mata_pelajarans()
	{
		return $this->hasMany(MataPelajaran::class);
	}
}