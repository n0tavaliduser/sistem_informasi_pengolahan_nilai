<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tuga
 * 
 * @property int $id
 * @property int $guru_id
 * @property int $mata_pelajaran_id
 * @property string $judul
 * @property string|null $deskripsi
 * @property Carbon $tanggal_deadline
 * @property string|null $file
 * @property string $status
 * @property string $tipe
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Guru $guru
 * @property MataPelajaran $mata_pelajaran
 *
 * @package App\Models
 */
class Tugas extends Model
{
	protected $table = 'tugas';

	protected $casts = [
		'guru_id' => 'int',
		'mata_pelajaran_id' => 'int',
		'tanggal_deadline' => 'datetime'
	];

	protected $fillable = [
		'guru_id',
		'mata_pelajaran_id',
		'judul',
		'deskripsi',
		'tanggal_deadline',
		'file',
		'status',
		'tipe'
	];

	public function guru()
	{
		return $this->belongsTo(Guru::class);
	}

	public function mata_pelajaran()
	{
		return $this->belongsTo(MataPelajaran::class);
	}
}
