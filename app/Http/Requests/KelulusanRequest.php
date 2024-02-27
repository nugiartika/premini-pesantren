<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KelulusanRequest extends FormRequest
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
            'santri_id' => 'required',
            'no_ujian' => 'required|numeric|min:0',
            'mapel_id' => 'required',
            'nilai' => 'required|numeric|min:0|max:100',
        ];
    }

    public function messages(): array
    {
        return[
            'santri_id.required' => 'Kolom NAMA SANTRI wajib diisi.',
            'no_ujian.required' => 'Kolom NO UJIAN wajib diisi.',
            'no_ujian.numeric' => 'NO UJIAN harus berupa angka',
            'no_ujian.min' => 'NO UJIAN tidak boleh MIN-',
            'mapel_id.required' => 'Kolom MAPEL wajib diisi.',
            'nilai.required' => 'Kolom NILAI wajib diisi.',
            'nilai.numeric' => ' NILAI harus berupa angka',
            'nilai.min' => ' NILAI tidak boleh MIN-',
            'nilai.max' => ' NILAI max 100',
        ];
    }
}
