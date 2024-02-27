<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GallerieRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_gallery' => 'required',
            'tanggal' => 'required|date|after_or_equal:today',
            'user_posting' => 'required',
            'sampul' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_gallery.required' => 'Kolom NAMA GALLERY wajib diisi.',
            'tanggal.required' => 'Kolom TANGGAL wajib diisi.',
            'tanggal.date' => 'Kolom TANGGAL harus berupa tanggal.',
            'tanggal.after_or_equal' => 'TANGGAL harus berisi tanggal yang sama dengan hari ini/terbaru.',            'foto.required' => 'Kolom FOTO  wajib diisi.',
            'user_posting.required' => 'Kolom USER POSTING wajib diisi.',
            'sampul.required' => 'Kolom SAMPUL wajib diisi.',
            'sampul.image' => 'Kolom SAMPUL harus berupa file gambar.',
            'sampul.mimes' => 'Format SAMPUL tidak valid. Gunakan format jpeg, png, jpg, atau gif.',
            'sampul.max' => 'Ukuran SAMPUL tidak boleh lebih dari 2 MB.',
            'status.required' => 'Kolom STATUS wajib diisi.',
        ];
    }
}
