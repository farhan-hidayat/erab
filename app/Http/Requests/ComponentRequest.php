<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ComponentRequest extends FormRequest
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
            'code'  => ['required', 'string', 'max:255', 'unique:components'],
            'name'  => ['required', 'string', 'max:255'],
            'detail_id'   => ['required', 'exists:details,id'],
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Kode harus diisi',
            'code.unique' => 'Kode sudah terdaftar',
            'name.required' => 'Nama harus diisi',
            'detail_id.required' => 'Kode harus diisi',
        ];
    }
}
