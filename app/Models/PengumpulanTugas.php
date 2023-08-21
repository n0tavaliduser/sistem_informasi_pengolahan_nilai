<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PengumpulanTugas
 * 
 * @property int $id
 * @property string|null $file
 * @property string|null $title
 * @property string|null $deskripsi
 * @property int $kelas_id
 * @property int $siswa_id
 * @property int $mata_pelajaran_id
 * @property int $tugas_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Kelas $kelas
 * @property MataPelajaran $mata_pelajaran
 * @property Siswa $siswa
 * @property Tugas $tugas
 *
 * @package App\Models
 */
class PengumpulanTugas extends Model
{
	const FILE_PATH = 'data/pengumpulan_tugas/files';

	protected $table = 'pengumpulan_tugas';

	protected $casts = [
		'kelas_id' => 'int',
		'siswa_id' => 'int',
		'mata_pelajaran_id' => 'int',
		'tugas_id' => 'int'
	];

	protected $fillable = [
		'file',
		'title',
		'deskripsi',
		'kelas_id',
		'siswa_id',
		'mata_pelajaran_id',
		'tugas_id'
	];

	public function kelas()
	{
		return $this->belongsTo(Kelas::class, 'kelas_id');
	}

	public function mata_pelajaran()
	{
		return $this->belongsTo(MataPelajaran::class);
	}

	public function siswa()
	{
		return $this->belongsTo(Siswa::class);
	}

	public function tugas()
	{
		return $this->belongsTo(Tugas::class, 'tugas_id');
	}
}
