<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Materi
 * 
 * @property int $id
 * @property int $jadwal_pelajaran_id
 * @property string $judul
 * @property Carbon $tanggal
 * @property string $file
 * @property string|null $deskripsi
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property JadwalPelajaran $jadwal_pelajaran
 *
 * @package App\Models
 */
class Materi extends Model
{
	const FILE_PATH = 'data/materi/files';

	protected $table = 'materi';

	protected $casts = [
		'jadwal_pelajaran_id' => 'int',
		'tanggal' => 'datetime'
	];

	protected $fillable = [
		'jadwal_pelajaran_id',
		'judul',
		'tanggal',
		'file',
		'deskripsi'
	];

	public function jadwal_pelajaran()
	{
		return $this->belongsTo(JadwalPelajaran::class);
	}
}
