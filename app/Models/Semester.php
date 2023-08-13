<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Semester
 * 
 * @property int $id
 * @property string $nama_semester
 * @property int $tahun_ajaran_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TahunAjaran $tahun_ajaran
 *
 * @package App\Models
 */
class Semester extends Model
{
	protected $table = 'semester';

	protected $casts = [
		'tahun_ajaran_id' => 'int'
	];

	protected $fillable = [
		'nama_semester',
		'tahun_ajaran_id'
	];

	public function tahun_ajaran()
	{
		return $this->belongsTo(TahunAjaran::class);
	}
}
