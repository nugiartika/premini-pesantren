<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BeritaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'judul_berita' => 'required|unique:beritas,judul_berita',
            'isi'  => 'required',
            'kategori_id' => 'required',
            'tanggal' => 'required|date|after_or_equal:today',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'judul_berita.required' => 'Kolom JUDUL BERITA wajib diisi.',
            'judul_berita.unique' => 'JUDUL BERITA sudah digunakan.',
            'isi.required' => 'Kolom ISI wajib diisi.',
            'kategori_id.required' => 'Kolom KATEGORI ID wajib diisi.',
            'tanggal.required' => 'Kolom TANGGAL wajib diisi.',
            'tanggal.date' => 'Kolom TANGGAL harus berupa tanggal.',
            'tanggal.after_or_equal' => 'Kolom TANGGAL harus setidaknya sama dengan tanggal hari ini.',
        ];
    }
}
