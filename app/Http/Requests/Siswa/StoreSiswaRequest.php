<?php

namespace App\Http\Requests\Siswa;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreSiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->role->name === 'Admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nomor_induk' => 'required|unique:siswa,nomor_induk,except,id',
            'nama_lengkap' => 'required|string|max:200',
            'agama' => 'required|string|max:25',
            'jenis_kelamin' => 'required|string|max:30',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required',
            'alamat' => 'required|string',
            'telepon' => 'required|string',
            'email' => 'required|unique:users,email,except,id',
            'kelas_id' => 'required|required|exists:kelas,id',
        ];
    }
}
