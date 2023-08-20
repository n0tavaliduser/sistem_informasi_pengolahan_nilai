<?php

namespace App\Http\Requests\Tugas;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateTugasRequest extends FormRequest
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
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_deadline' => [
                'required',
                'date',
                Rule::requiredIf($this->method() == 'POST'), // Hanya diperlukan pada saat pembuatan
                function ($attribute, $value, $fail) {
                    if ($value <= now()->addDay()) {
                        $fail('The '.$attribute.' must be a date after tomorrow.');
                    }
                },
            ],
            'tipe' => 'required|string',
        ];
    }
}
