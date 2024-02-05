<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SyahriahRequest extends FormRequest
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
                'santri_id' => [
                    'required',
                    Rule::unique('syahriahs')->ignore($this->route('syahriah'), 'id'),
                ],
        ];
    }

    public function messages(): array
    {
        return [
            'santri_id.required' => 'nama santri tidak boleh kosong.',
            'santri_id.unique' => 'santri sudah ada sebelumnya.',
        ];
    }
}
