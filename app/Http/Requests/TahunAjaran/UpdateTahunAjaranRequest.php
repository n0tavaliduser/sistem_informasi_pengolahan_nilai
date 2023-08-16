<?php

namespace App\Http\Requests\TahunAjaran;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateTahunAjaranRequest extends FormRequest
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
            'tahun_mulai' => 'required|integer',
            'tahun_berakhir' => 'required|integer|gt:tahun_mulai',
            'jumlah_semester' => 'required|integer',
            'status' => 'required|in:active,deactive',
        ];
    }
}
