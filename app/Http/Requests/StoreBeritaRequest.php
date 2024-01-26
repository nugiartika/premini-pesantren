<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

<<<<<<< Updated upstream
<<<<<<<< Updated upstream:app/Http/Requests/StoreBeritaRequest.php
class StoreBeritaRequest extends FormRequest
========
class UpdateBeritaRequest extends FormRequest
>>>>>>>> Stashed changes:app/Http/Requests/UpdateBeritaRequest.php
=======
<<<<<<<< Updated upstream:app/Http/Requests/UpdateBeritaRequest.php
class UpdateBeritaRequest extends FormRequest
========
class StoreBeritaRequest extends FormRequest
>>>>>>>> Stashed changes:app/Http/Requests/StoreBeritaRequest.php
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
            //
=======
<<<<<<<< Updated upstream:app/Http/Requests/UpdateBeritaRequest.php
            //
========
        // 
>>>>>>>> Stashed changes:app/Http/Requests/StoreBeritaRequest.php
>>>>>>> Stashed changes
        ];
    }
}
