<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class GroupRequest extends FormRequest
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
            'code'  => ['required', 'string', 'max:255', 'unique:groups'],
            'name'  => ['required', 'string', 'max:255'],
            'resource_id'   => ['required', 'exists:resources,id'],
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Kode harus diisi',
            'code.unique' => 'Kode sudah terdaftar',
            'name.required' => 'Nama harus diisi',
            'resource_id.required' => 'Kode harus diisi',
        ];
    }
}
