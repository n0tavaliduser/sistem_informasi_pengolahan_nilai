<?php

namespace App\Http\Requests\JadwalPelajaran;

use Illuminate\Foundation\Http\FormRequest;

class StoreJadwalPelajaranRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Adjust authorization logic as needed
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'hari' => 'required|string|max:10',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_berakhir' => 'required|date_format:H:i|after:jam_mulai',
            'kelas_id' => 'required|exists:kelas,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id',
            'guru_id' => 'nullable|exists:guru,id',
            'mata_pelajaran_id' => 'nullable|exists:mata_pelajaran,id',
            'semester' => 'required|string|max:8',

            // 'hari' => 'unique:jadwal_pelajaran,hari,jam_mulai,guru_id',
            // 'kelas_id' => 'unique:jadwal_pelajaran,kelas_id,hari,mata_pelajaran_id',
        ];
    }
}
