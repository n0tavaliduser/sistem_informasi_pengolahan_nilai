<?php

namespace App\Http\Requests\Kelas;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateKelasRequest extends FormRequest
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
            'nama_kelas' => 'required|string|max:20',
            'tingkat' => 'required|numeric',
            'guru_id' => 'required|exists:guru,id',
            'jurusan_id' => 'required|exists:jurusan,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id'
        ];
    }
}
