<?php

namespace App\Http\Requests\NilaiMataPelajaran;

use Illuminate\Foundation\Http\FormRequest;

class StoreNilaiMataPelajaranRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
            'siswa_id' => 'required|exists:siswa,id',
            'pertemuan' => 'required',
            'nilai' => 'required|numeric|min:0|max:100' 
        ];
    }
}
