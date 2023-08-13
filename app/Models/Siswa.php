<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Siswa
 * 
 * @property int $id
 * @property int $nomor_induk
 * @property string $nama_lengkap
 * @property string $agamar
 * @property string $status
 * @property string|null $foto
 * @property string|null $catatan
 * @property string $jenis_kelamin
 * @property string $tempat_lahir
 * @property Carbon $tanggal_lahir
 * @property string $alamat
 * @property string $telepon
 * @property string $email
 * @property int $kelas_id
 * @property int $tahun_ajaran_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Kela $kela
 * @property TahunAjaran $tahun_ajaran
 *
 * @package App\Models
 */
class Siswa extends Model
{
	protected $table = 'siswa';

	protected $casts = [
		'nomor_induk' => 'int',
		'tanggal_lahir' => 'datetime',
		'kelas_id' => 'int',
		'tahun_ajaran_id' => 'int'
	];

	protected $fillable = [
		'nomor_induk',
		'nama_lengkap',
		'agamar',
		'status',
		'foto',
		'catatan',
		'jenis_kelamin',
		'tempat_lahir',
		'tanggal_lahir',
		'alamat',
		'telepon',
		'email',
		'kelas_id',
		'tahun_ajaran_id'
	];

	public function kelas()
	{
		return $this->belongsTo(Kelas::class, 'kelas_id');
	}

	public function tahun_ajaran()
	{
		return $this->belongsTo(TahunAjaran::class);
	}
}
