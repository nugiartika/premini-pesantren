<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatemapelRequest extends FormRequest
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
    public function rules():array
    {
        return [
            'nama' => 'required|unique:mapels,nama',
        ];
    }

 /**
     * Get the error messages for the defined validation rules.
     *
     * @return 
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'Kolom NAMA MAPEL wajib diisi.',
            'nama.unique' => 'NAMA MAPEL sudah digunakan.',
        ];
    }
}
