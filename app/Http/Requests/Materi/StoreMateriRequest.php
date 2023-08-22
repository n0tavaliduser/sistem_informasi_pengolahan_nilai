<?php

namespace App\Http\Requests\Materi;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreMateriRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->role->name == 'Guru';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'jadwal_pelajaran_id' => 'required|exists:jadwal_pelajaran,id',
            'judul' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'file' => 'required',
            'deskripsi' => 'nullable|string',
        ];
    }
}
