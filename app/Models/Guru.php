<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Guru
 * 
 * @property int $id
 * @property string $nama_lengkap
 * @property string $jenis_kelamin
 * @property string|null $nomor_nip
 * @property Carbon $tanggal_lahir
 * @property string $alamat
 * @property int $jurusan_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Jurusan $jurusan
 * @property User $user
 * @property Collection|JadwalPelajaran[] $jadwal_pelajarans
 * @property Collection|Kela[] $kelas
 * @property Collection|Tuga[] $tugas
 *
 * @package App\Models
 */
class Guru extends Model
{
	use HasFactory;

	protected $table = 'guru';

	protected $casts = [
		'tanggal_lahir' => 'datetime',
		'jurusan_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'nama_lengkap',
		'jenis_kelamin',
		'nomor_nip',
		'tanggal_lahir',
		'alamat',
		'jurusan_id',
		'user_id'
	];

	public function jurusan()
	{
		return $this->belongsTo(Jurusan::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function jadwal_pelajarans()
	{
		return $this->hasMany(JadwalPelajaran::class);
	}

	public function kelas()
	{
		return $this->hasMany(Kelas::class);
	}

	public function tugas()
	{
		return $this->hasMany(Tugas::class);
	}
}
