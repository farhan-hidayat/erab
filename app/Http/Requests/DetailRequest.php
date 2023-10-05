<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DetailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'code'  => ['required', 'string', 'max:255', 'unique:details'],
            'name'  => ['required', 'string', 'max:255'],
            'classification_id'   => ['required', 'exists:classifications,id'],
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Kode harus diisi',
            'code.unique' => 'Kode sudah terdaftar',
            'name.required' => 'Nama harus diisi',
            'classification_id.required' => 'Kode harus diisi',
        ];
    }
}
