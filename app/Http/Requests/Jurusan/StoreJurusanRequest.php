<?php

namespace App\Http\Requests\Jurusan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreJurusanRequest extends FormRequest
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
            'nama_jurusan' => 'required|string|max:50',
            'singkatan' => 'required|string|max:10|unique:jurusan,singkatan,except,id',
            'keterangan' => 'nullable|string'
        ];
    }
}
